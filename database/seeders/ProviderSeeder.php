<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Provider;
use App\Models\Tourist;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProviderSeeder extends Seeder
{
    public function run()
    {
                
        $categories = Category::all();

        $providers = [
            [
                'name' => 'الرونق للرحلات',
                'title' => ' أجمل الرحلات إلى الأماكن والمعالم الأثرية',
                'email' => 'ahmed@example.com',
                'category_id' => $categories->where('name', 'معالم أثرية')->first()->id, // تعيين فئة صيانة
                'location' => DB::raw("POINT(33.5138, 36.2765)"), // حلب
            ],
            [
                'name' => 'مطعم دمشق',
                'title' => 'أطيب وأشهى المأكولات الشرقية',
                'email' => 'sara@example.com',
                'category_id' => $categories->where('name', 'مطاعم')->first()->id, // تعيين فئة تنظيف
                'location' => DB::raw("POINT(37.1612, 33.1613)"), // دمشق
            ],
            [
                'name' => 'مركز الشفاء',
                'title' => 'أسعار اقتصادية، جودة عالية أحدث الأجهزة مع أفضل الخبراء ',
                'email' => 'mohamed@example.com',
                'category_id' => $categories->where('name', 'خدمات علاجية')->first()->id, // تعيين فئة حدادة
                'location' => DB::raw("POINT(37.1343, 36.2021)"), // حمص
            ],
            [
                'name' => 'الرونق للتجميل',
                'title' => 'وصفات عربية لجمال دائم',
                'email' => 'ali@example.com',
                'category_id' => $categories->where('name', 'تجميل')->first()->id, // تعيين فئة كهرباء
                'location' => DB::raw("POINT(36.6341, 35.9294)"), // إدلب
            ],
            [
                'name' => 'عيادة الحياة الجديدة',
                'title' => 'عيادة الحياة الجديدة - خطواتك نحو الأمومة.',
                'email' => 'fatima@example.com',
                'category_id' => $categories->where('name', 'علاج العقم')->first()->id, // تعيين فئة تجميل
                'location' => DB::raw("POINT(36.7256, 35.7644)"), // دير الزور
            ],
            [
                'name' => 'يوسف العبد الله',
                'title' => 'افخر السيارات ',
                'email' => 'youssef@example.com',
                'category_id' => $categories->where('name', 'خدمات النقل')->first()->id, // تعيين فئة نقل
                'location' => DB::raw("POINT(37.2915, 36.0937)"), // الرقة
            ],
            [
                'name' => 'مول الأثريات العريقة',
                'title' => 'حي التراث.',
                'email' => 'aisha@example.com',
                'category_id' => $categories->where('name', 'تسوق')->first()->id, // تعيين فئة طبخ
                'location' => DB::raw("POINT(37.3757, 36.2986)"), // حماة
            ],
            [
                'name' => 'فندق الفصول الأربعة',
                'title' => 'في قلب دمشق الساحرة.',
                'email' => 'p@p.com',
                'category_id' => $categories->where('name', 'فنادق')->first()->id, // تعيين فئة تصميم
                'location' => DB::raw("POINT(36.6667, 35.8333)"), // السويداء
            ],
            [
                'name' => 'الذكريات',
                'title' => 'صور تحكي قصصاً... مع مونتاج مدهش.',
                'email' => 'hala@example.com',
                'category_id' => $categories->where('name', 'خدمات تصوير')->first()->id, // تعيين فئة تصوير
                'location' => DB::raw("POINT(36.7500, 35.8000)"), // طرطوس
            ],
            [
                'name' => 'مشفى الأمل',
                'title' => 'أحدث التقنيات والخبرات.',
                'email' => 'karim@example.com',
                'category_id' => $categories->where('name', 'خدمات علاجية')->first()->id, // تعيين فئة صيانة سيارات
                'location' => DB::raw("POINT(37.1000, 36.2000)"), // اللاذقية
            ],
        ];

        foreach ($providers as $providerData) {
            // إنشاء مستخدم جديد لكل مزود خدمة مع كلمة سر ثابتة
            $user = User::create([
                'email' => $providerData['email'],
                'password' => '123', // كلمة سر ثابتة
                'type' => 'provider', // تعيين النوع إلى "مزود"
            ]);

            // إنشاء مزود الخدمة وربطه بالمستخدم
             Provider::create([
                'name' => $providerData['name'],
                'description' => $providerData['title'],
                'user_id' => $user->id, // ربط المزود بالمستخدم
                'location' => $providerData['location'],
                // 'category_id' => $providerData['category_id'], // إضافة category_id
            ])->categories()->attach($providerData['category_id']);

        }
    }
}
