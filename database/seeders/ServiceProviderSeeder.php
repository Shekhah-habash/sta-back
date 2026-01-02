<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Provider;
use App\Models\Tourist;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceProviderSeeder extends Seeder
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
                'title' => 'مقدم خدمات الحدادة.',
                'email' => 'mohamed@example.com',
                'category_id' => $categories->where('name', 'خدمات حدادة')->first()->id, // تعيين فئة حدادة
                'location' => DB::raw("POINT(37.1343, 36.2021)"), // حمص
            ],
            [
                'name' => 'علي الكردي',
                'title' => 'مقدم خدمات الكهرباء.',
                'email' => 'ali@example.com',
                'category_id' => $categories->where('name', 'خدمات كهرباء')->first()->id, // تعيين فئة كهرباء
                'location' => DB::raw("POINT(36.6341, 35.9294)"), // إدلب
            ],
            [
                'name' => 'فاطمة الزهراء',
                'title' => 'مقدمة خدمات التجميل.',
                'email' => 'fatima@example.com',
                'category_id' => $categories->where('name', 'خدمات تجميل')->first()->id, // تعيين فئة تجميل
                'location' => DB::raw("POINT(36.7256, 35.7644)"), // دير الزور
            ],
            [
                'name' => 'يوسف العبد الله',
                'title' => 'مقدم خدمات النقل.',
                'email' => 'youssef@example.com',
                'category_id' => $categories->where('name', 'خدمات نقل')->first()->id, // تعيين فئة نقل
                'location' => DB::raw("POINT(37.2915, 36.0937)"), // الرقة
            ],
            [
                'name' => 'عائشة العلي',
                'title' => 'مقدمة خدمات الطبخ.',
                'email' => 'aisha@example.com',
                'category_id' => $categories->where('name', 'خدمات طبخ')->first()->id, // تعيين فئة طبخ
                'location' => DB::raw("POINT(37.3757, 36.2986)"), // حماة
            ],
            [
                'name' => 'سمير القاضي',
                'title' => 'مقدم خدمات تصميم المواقع.',
                'email' => 'samir@example.com',
                'category_id' => $categories->where('name', 'خدمات تصميم')->first()->id, // تعيين فئة تصميم
                'location' => DB::raw("POINT(36.6667, 35.8333)"), // السويداء
            ],
            [
                'name' => 'هالة النعسان',
                'title' => 'مقدمة خدمات التصوير الفوتوغرافي.',
                'email' => 'hala@example.com',
                'category_id' => $categories->where('name', 'خدمات تصوير')->first()->id, // تعيين فئة تصوير
                'location' => DB::raw("POINT(36.7500, 35.8000)"), // طرطوس
            ],
            [
                'name' => 'كريم الصالح',
                'title' => 'مقدم خدمات صيانة السيارات.',
                'email' => 'karim@example.com',
                'category_id' => $categories->where('name', 'خدمات صيانة سيارات')->first()->id, // تعيين فئة صيانة سيارات
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
                'description' => $providerData['description'],
                'user_id' => $user->id, // ربط المزود بالمستخدم
                'location' => $providerData['location'],
                'category_id' => $providerData['category_id'], // إضافة category_id
            ]);
        }
    }
}
