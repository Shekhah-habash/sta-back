<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProviderResource;
use App\Models\Booking;
use App\Models\Provider;
use App\Notifications\ProviderAccountAccepted;
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
            ST_Y(location) AS lat ,
            ST_X(location) AS lng
        ")
            ->with('image')
            ->when($accepted, function ($q) use ($accepted) {
                $accepted = $accepted == "yes" ? 1 : ($accepted == "no" ? 0 : null);
                return $q->where('accepted',  $accepted);
            })->get();
        //   return $providers;              
        return apiSuccess('مزودي الخدمة ',  ProviderResource::collection($providers));
    }

    public function acceptProvider(Provider $provider)
    {
        $provider->update(['accepted' => 1]);
        $provider->user->notify(new ProviderAccountAccepted());
        return apiSuccess("تم  قبول مزودالخدمة بنجاح");
    }

    public function totals()
    {
        return apiSuccess("إجماليات", [
            'categories' => \App\Models\Category::count(),
            'tourists' => \App\Models\Tourist::count(),
            'providers' => Provider::count(),
            'bookings' => Booking::count(),
        ]);
    }
}
