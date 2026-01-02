<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Preference;

class CategoriesAndPreferencesSeeder extends Seeder
{
    public function run()
    {
        // Define categories and their corresponding preferences
        $data = [
            'رحلات ترفيهية' => [
               
            ],
            'خدمات عامة' => [
                'توصيل من المطار',
                'تأجير سيارات',
                'خدمات النقل العام'
            ],
            'حجز فنادق' => [
                'حجز فندق خمس نجوم',
                'حجز فندق اقتصادي',
                'توصيل من المطار',
                'مسبح',
                'منتجع',
                'مطعم'
            ]
        ];

        // Iterate over the categories and preferences
        foreach ($data as $category => $subCategories) {
            // Create the category
            $parent = Category::create(['name' => $category]);

            // Create the preferences associated with the category
            foreach ($preferences as $preferenceName) {
                Preference::create([
                    'name' => $preferenceName,
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
