<?php

namespace Database\Seeders;

use App\Models\Preference;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $favors = [
            ['name' => 'رياضة ' , 'type' => 'favor'],
            ['name' => 'مناظر طبيعية' , 'type' => 'favor'],
            ['name' => 'هدوء ' ,  'type' => 'favor'],
            ['name' => 'ألعاب  ' ,  'type' => 'favor'],
            ['name' => 'تسوق' ,  'type' => 'favor'],                
           
        ];
        Preference::insert($favors);
         $medicals = [
            ['name' => ' حساسية تنفسية' , 'type' => 'medical'],
            ['name' => 'حساسية للأغذية الصناعية ' , 'type' => 'medical'],
            ['name' => 'ارتفاع ضغط الدم ' ,  'type' => 'medical'],                            
           
        ];
        Preference::insert($medicals);
    }
}
