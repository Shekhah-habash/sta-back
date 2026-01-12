<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    // $table->rememberToken();
    public function run(): void
    {
        /** admin */
        User::create(
            [
                'id' => 1,
                'email' => 'a@a.com',
                'password' => '123',
                /** hashed through model */
                'type' => 'admin'
            ]
        );

        /** user + tourist   */
        User::create([
            'email' => 't@t.com',
            'password' => '123',
            'type' => 'tourist',
        ])->tourist()->create([
            'name' => 'همام',
            'DOB' => '2000-01-01',
            'gender' => 'M',
            'country_id' => 200,
        ]);

        $tourist = user::where('email', 't@t.com')->first()->tourist;
        $categories = Category::wherein('name', ['الإقامة', 'فنادق', 'حجز فندق خمس نجوم', 'غرفة فردية', 'غرفة ثنائية', 'غرفة ثلاثية', 'استديو 4 أشخاص', 'استديو 7 أشخاص', 'علاج طبيعي', 'استشارة تغذية', 'معالم أثرية', 'تجربة الطعام المحلي',])->get();
        $tourist->profiles()->attach($categories);
    }
}
