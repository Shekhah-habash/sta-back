<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Provider;
use App\Models\Tourist;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProviderAndServicesSeeder extends Seeder
{
    public function run()
    {

        $categories = Category::all();

        $providers = [
            [
                'name' => 'فندق الفصول الأربعة',
                'title' => 'في قلب دمشق الساحرة.',
                'email' => 'p@p.com',
                'categories' => Category::wherein('name', ['الإقامة', 'فنادق', 'حجز فندق خمس نجوم', 'غرفة فردية', 'غرفة ثنائية', 'غرفة ثلاثية', 'استديو 4 أشخاص', 'استديو 7 أشخاص',])->get(),
                'location' => DB::raw("POINT(36.6667, 35.8333)"), // السويداء
                'province_id' => 5,
                'accepted' => 1
            ],
            [
                'name' => 'مركز الشفاء',
                'title' => 'أسعار اقتصادية، جودة عالية أحدث الأجهزة مع أفضل الخبراء ',
                'email' => 'p2@p2.com',
                'categories' => Category::wherein('name', ['علاج طبيعي', 'استشارة تغذية',  'خدمات علاجية'])->get(),
                'location' => DB::raw("POINT(37.1343, 36.2021)"), // حمص
                'province_id' => 14,
            ],
            [
                'name' => 'الرونق للرحلات',
                'title' => ' أجمل الرحلات إلى الأماكن والمعالم الأثرية',
                'email' => 'p3@p3.com',
                'categories' => Category::wherein('name', ['معالم أثرية' , 'تجربة الطعام المحلي'])->get(),
                'location' => DB::raw("POINT(33.5138, 36.2765)"), // حلب
                'province_id' => 2,
            ],
            [
                'name' => 'مطعم دمشق',
                'title' => 'أطيب وأشهى المأكولات الشرقية',
                'email' => 'sara@example.com',
                'categories' => $categories->where('name', 'مطاعم')->first()->id,
                'location' => DB::raw("POINT(37.1612, 33.1613)"), // دمشق
                'province_id' => 1,
            ],

            [
                'name' => 'الرونق للتجميل',
                'title' => 'وصفات عربية لجمال دائم',
                'email' => 'ali@example.com',
                'categories' => $categories->where('name', 'تجميل')->first()->id,
                'location' => DB::raw("POINT(36.6341, 35.9294)"), // إدلب
                'province_id' => 9,
            ],
            [
                'name' => 'عيادة الحياة الجديدة',
                'title' => 'عيادة الحياة الجديدة - خطواتك نحو الأمومة.',
                'email' => 'fatima@example.com',
                'categories' => $categories->where('name', 'علاج العقم')->first()->id,
                'location' => DB::raw("POINT(36.7256, 35.7644)"), // دير الزور
                'province_id' => 13,
            ],
            [
                'name' => 'يوسف العبد الله',
                'title' => 'افخر السيارات ',
                'email' => 'youssef@example.com',
                'categories' => $categories->where('name', 'خدمات النقل')->first()->id,
                'location' => DB::raw("POINT(37.2915, 36.0937)"), // الرقة
                'province_id' => 12,
            ],
            [
                'name' => 'مول الأثريات العريقة',
                'title' => 'حي التراث.',
                'email' => 'aisha@example.com',
                'categories' => $categories->where('name', 'تسوق')->first()->id,
                'location' => DB::raw("POINT(37.3757, 36.2986)"), // حماة
                'province_id' => 10,
            ],
            [
                'name' => 'الذكريات',
                'title' => 'صور تحكي قصصاً... مع مونتاج مدهش.',
                'email' => 'hala@example.com',
                'categories' => $categories->where('name', 'خدمات تصوير')->first()->id,
                'location' => DB::raw("POINT(36.7500, 35.8000)"), // طرطوس
                'province_id' => 8,
            ],
            [
                'name' => 'مشفى الأمل',
                'title' => 'أحدث التقنيات والخبرات.',
                'email' => 'karim@example.com',
                'categories' => $categories->where('name', 'خدمات علاجية')->first()->id,
                'location' => DB::raw("POINT(37.1000, 36.2000)"), // اللاذقية
                'province_id' => 7,
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
                'title' => $providerData['title'],
                'user_id' => $user->id, // ربط المزود بالمستخدم
                'location' => $providerData['location'],
                'province_id' => $providerData['province_id'],
            ])->categories()->attach($providerData['categories']);
        }


        $provider = user::where('email', 'p@p.com')->first()->provider;
        $services = [
            ['name' => 'غرفة إفرادية', 'identifier' => 'ID1', 'details' => ''],
            ['name' => 'غرفة مزودجة', 'identifier' => 'ID2', 'details' => ''],
            ['name' => 'استديو 4 أشخاص', 'identifier' => 'ID3', 'details' => ''],
            ['name' => 'استديو 5 أشخاص', 'identifier' => 'ID4', 'details' => ''],
        ];
        foreach ($services as $service) {
            $provider->services()->create($service);
        }
        
        
        $provider = user::where('email', 'p2@p2.com')->first()->provider;
        // 'علاج طبيعي', 'استشارة تغذية'
        $services = [
            ['name' => 'جلسات للبشرة نقية', 'identifier' => 'ID1', 'details' => ''],
            ['name' => 'نظام غذائي متكامل لمدة شهر ', 'identifier' => 'ID2', 'details' => ''],
    
        ];
        foreach ($services as $service) {
            $provider->services()->create($service);
        }
        
        $provider = user::where('email', 'p3@p3.com')->first()->provider;
        // 'معالم أثرية' , 'تجربة الطعام المحلي'
        $services = [
            ['name' => 'دمشق القديمة مع إفطار', 'identifier' => 'ID1', 'details' => ''],
            ['name' => 'رحلة إلى مدرج بصرى', 'identifier' => 'ID2', 'details' => ''],
    
        ];
        foreach ($services as $service) {
            $provider->services()->create($service);
        }
    }
}
