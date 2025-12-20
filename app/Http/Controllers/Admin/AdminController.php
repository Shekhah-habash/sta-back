<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProviderResource;
use App\Models\Provider;
use Illuminate\Http\Request;

class AdminController extends Controller
{
        

    public function getProviders(Request $request)
    {
        $accepted = $request->accepted;
        $providers = Provider::selectRaw("
            id,
            name,
            description, 
            accepted,
            image_id,
            ST_Y(location) AS lat,
            ST_X(location) AS lng
        ")
        ->when($accepted , function($q) use ($accepted){
            return $q->whereAccepted($accepted);
        })->get();        
        //   return $providers;              
        return apiSuccess('مزودي الخدمة ',  ProviderResource::collection( $providers));
    }
    
    public function toggleState(Provider $provider)
    {
        $provider->update(['accepted' => ! $provider->accepted]);
        return apiSuccess("تم تعديل مزود الخدمة بنجاح", $provider);
    }

    public function totals()
    {
        return apiSuccess("إجماليات", [
            'categories' => \App\Models\Category::count(),
            'tourists' => \App\Models\Tourist::count(),
                'providers' => Provider::whereAccepted(true)->count(),
            'bookings' => \App\Models\Booking::count(),
        ]);
    }
}
