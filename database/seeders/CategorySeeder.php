<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ServiceType;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        $categories = [
            [
                'name' => 'الرحلات',
                'children' => [
                    [
                        'name' => 'رحلات ترفيهية',
                        'children' => [
                            ['name' => 'التخييم',],
                            ['name' => 'الذهاب إلى الشاطئ',],
                            ['name' => 'المشي في الطبيعة',],
                            ['name' => 'ركوب الدراجة',],
                            ['name' => 'رحلات السفاري',],
                            ['name' => 'زيارة المعالم السياحية',],
                            ['name' => 'الرحلات البحرية',],
                            ['name' => 'الذهاب إلى المنتزهات',],
                            ['name' => 'تجربة الطعام المحلي',],
                            ['name' => 'الذهاب إلى السينما',],
                            ['name' => 'حضور الحفلات الموسيقية',],
                            ['name' => 'زيارة المتاحف',],
                            ['name' => 'الذهاب إلى الحدائق العامة',],
                            ['name' => 'الرياضات المائية',],
                            ['name' => 'الرحلات الثقافية',],
                            ['name' => 'الاسترخاء في المنتجعات الصحية',],
                            ['name' => 'التزلج على الماء',],
                            ['name' => 'الذهاب إلى المعارض الفنية'],
                        ]
                    ],
                ],
            ],
            [
                'name' => 'المعالم',
                'children' => [
                    ['name' => 'معالم دينية'],
                    ['name' => 'معالم أثرية'],
                    ['name' => 'معالم ثقافية'],
                ],
            ],
            [
                'name' => 'تسوق',
                'children' => [
                    ['name' => 'مولات'],
                    ['name' => 'انتيكا'],
                    ['name' => 'ألبسة'],
                    ['name' => 'مجوهرات'],
                    ['name' => 'عطور'],
                ],
            ],
            [
                'name' => 'الإقامة',
                'children' => [
                    [
                        'name' => 'فنادق',
                        'children' => [
                            [
                                'name' => 'حجز فندق خمس نجوم',
                                'children' => [
                                    ['name' => 'غرفة فردية',],
                                    ['name' => 'غرفة ثنائية',],
                                    ['name' => 'غرفة ثلاثية',],
                                    ['name' => 'استديو 4 أسخاص',],
                                    ['name' => 'استديو 7 أسخاص',],
                                ]
                            ],
                            [
                                'name' => 'حجز فندق اقتصادي',
                                'children' => [
                                    ['name' => 'غرفة فردية',],
                                    ['name' => 'غرفة ثنائية',],
                                    ['name' => 'غرفة ثلاثية',],
                                    ['name' => 'استديو 4 أسخاص',],
                                    ['name' => 'استديو 7 أسخاص',],
                                ]
                            ],
                        ],
                    ],
                    ['name' => 'استراحات'],
                ],
            ],
            [
                'name' => 'خدمات علاجية',
                'children' => [
                    ['name' => 'فحص طبي شامل'],
                    ['name' => 'علاج طبيعي'],
                    ['name' => 'استشارة نفسية'],
                    ['name' => 'علاج الأسنان'],
                    ['name' => 'فحص دم'],
                    ['name' => 'فحص سكر'],
                    ['name' => 'فحص ضغط الدم'],
                    ['name' => 'استشارة تغذية'],
                    ['name' => 'علاج بدني'],
                    ['name' => 'استشارة جلدية'],
                    ['name' => 'علاج العقم'],
                    ['name' => 'فحص نظر'],
                    ['name' => 'استشارة قلبية'],
                    ['name' => 'علاج الربو'],
                    ['name' => 'استشارة طبية عن الأمراض المزمنة'],
                    ['name' => 'استشارة طبية عامة'],
                    ['name' => 'فحص سرطان '],
                    ['name' => 'استشارة طبية للنساء'],
                    ['name' => 'حساسية الأنف'],
                    ['name' => 'ارتفاع ضغط الدم'],
                    ['name' => 'سكري النوع الثاني'],
                    ['name' => 'أمراض القلب'],
                    ['name' => 'الربو التحسسي'],
                    ['name' => 'التهاب المفاصل'],
                    ['name' => 'أمراض الكلى'],
                    ['name' => 'الصداع النصفي'],
                    ['name' => 'التهاب الأمعاء'],
                    ['name' => 'مرض السكري'],
                    ['name' => 'تجميل'],
                ],
            ],
            [
                'name' => 'خدمات النقل',
                'children' => [
                    ['name' => 'سيارات الأجرة'],
                    ['name' => 'حافلات النقل'],
                    ['name' => 'تأجير سيارات'],
                    ['name' => 'حافلات النقل العام'],
                    ['name' => 'توصيل من المطار'],
                ],
            ],
            [
                'name' => 'مطاعم',
                'children'=> [ 
                    ['name' => 'مأكولات بحرية'],
                    ['name' => 'مأكولات شرقية'],
                    ['name' => 'حلويات عربية'],
                ],
            ],
            [
                'name' => 'خدمات تصوير',
                'children'=> [ 
                    ['name' => 'تصوير يومي'],
                    ['name' => 'مناسبات'],
                ],
            ]
        ];

        $this->insertCategories($categories);
    }
    private function insertCategories(array $categories, $parentId = null)
    {
        foreach ($categories as $category) {
            $newCategory = Category::create(['name' => $category['name'], 'category_id' => $parentId]);

            if (isset($category['children'])) {
                $this->insertCategories($category['children'], $newCategory->id);
            }
        }
    }
}
