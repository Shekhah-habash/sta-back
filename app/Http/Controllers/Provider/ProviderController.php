<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProviderResource;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getInfo(Request $request)
    {

        $provider = $request->user()->provider()->with('image')->selectRaw("
            name,
            description, 
            accepted,
            image_id,
            ST_Y(location) AS lng ,
            ST_X(location) AS lat")->first();

        // return $provider;
        return apiSuccess("معلومات المزود", new ProviderResource($provider));
    }
}
