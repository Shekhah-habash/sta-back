<?php

namespace Database\Seeders;

use App\Models\Provider;
use App\Models\Tourist;
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
        User::create(
            [
                'id' => 1,
                'email' => 'a@a.com',
                'password' => '123',
                /** hashed through model */
                'type' => 'admin'
            ]
        );

        /** tourist 1 */
        User::create([
            'id' => 2,
            'email' => 't@t.com',
            'password' => '123',
            'type' => 'tourist'
        ]);
        Tourist::create([
            'id' => 1,
            'name' => 'tourist account 1',
            'country_id' => 200,
            'DOB' => '2000-01-01',
            'gender' => 'F',
            'user_id' => 2
        ]);


        /** tourist 2 */
        User::create([
            'id' => 3,
            'email' => 'to@to.com',
            'password' => '123',
            'type' => 'tourist',
        ]);
        Tourist::create([
            'id' => 2,
            'name' => 'tourist account 2',
            'country_id' => 100,
            'DOB' => '2000-01-01',
            'gender' => 'M',
            'user_id' => 3
        ]);
        /** Provider 2 */
        User::create([
            'id' => 4,
            'email' => 'p@p.com',
            'password' => '123',
            'type' => 'provider'
        ]);


        Provider::create([
            'id' => 1,
            'name' => 'Provider account',
            'description' => 'Provider account for test pupose',
            'accepted' => true, 
            'user_id' => 4
        ]);
    }
}
