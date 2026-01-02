<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder1 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $preferences = [
            // Medical Questions
            ['type' => 'fun', 'name' => 'معالم دينية'],
            ['type' => 'fun', 'name' => 'معالم أثرية'],
            ['type' => 'fun', 'name' => 'معالم ثقافية'],
            ['type' => 'fun', 'name' => 'معالم طبيعة',],

            ['type' => 'medical', 'name' => 'استشارة طبية'],
            ['type' => 'medical', 'name' => 'فحص طبي شامل'],

            ['type' => 'medical', 'name' => 'ارتفاع ضغط دم'],
            ['type' => 'medical', 'name' => 'مرض سكري'],
            ['type' => 'medical', 'name' => 'فحص ضغط الدم'],
            ['type' => 'medical', 'name' => 'علاج بدني'],
            ['type' => 'medical', 'name' => 'استشارة جلدية'],
            ['type' => 'medical', 'name' => 'فحص نظر'],
            ['type' => 'medical', 'name' => 'استشارة قلبية'],
            ['type' => 'medical', 'name' => 'علاج الربو'],
            ['type' => 'medical', 'name' => 'استشارة طبية عن الأمراض المزمنة'],
            ['type' => 'medical', 'name' => 'استشارة طبية عامة'],
            ['type' => 'medical', 'name' => 'فحص سرطان'],
            ['type' => 'medical', 'name' => 'استشارة طبية للنساء'],
            ['type' => 'medical', 'name' => ' حساسية تنفسية'],
            ['type' => 'medical', 'name' => 'حساسية للأغذية الصناعية '],
            ['type' => 'medical', 'name' => 'ارتفاع ضغط الدم'],


            // ترفيهية Questions
            ['type' => 'favor', 'name' => 'السباحة'],
            ['type' => 'favor', 'name' => 'التخييم'],
            ['type' => 'favor', 'name' => 'الذهاب إلى الشاطئ'],
            ['type' => 'favor', 'name' => 'المشي في الطبيعة'],
            ['type' => 'favor', 'name' => 'ركوب الدراجة'],
            ['type' => 'favor', 'name' => 'رحلات السفاري'],
            ['type' => 'favor', 'name' => 'زيارة المعالم السياحية'],
            ['type' => 'favor', 'name' => 'الرحلات البحرية'],
            ['type' => 'favor', 'name' => 'الذهاب إلى المنتزهات'],
            ['type' => 'favor', 'name' => 'تجربة الطعام المحلي'],
            ['type' => 'favor', 'name' => 'الذهاب إلى السينما'],
            ['type' => 'favor', 'name' => 'حضور الحفلات الموسيقية'],
            ['type' => 'favor', 'name' => 'زيارة المتاحف'],
            ['type' => 'favor', 'name' => 'التسوق في الأسواق المحلية'],
            ['type' => 'favor', 'name' => 'الذهاب إلى الحدائق العامة'],
            ['type' => 'favor', 'name' => 'الرياضات المائية'],
            ['type' => 'favor', 'name' => 'الرحلات الثقافية'],
            ['type' => 'favor', 'name' => 'الاسترخاء في المنتجعات الصحية'],
            ['type' => 'favor', 'name' => 'التزلج على الماء'],
            ['type' => 'favor', 'name' => 'الذهاب إلى المعارض الفنية'],
        ];
        // Preference::insert($preferences);

    }
}
