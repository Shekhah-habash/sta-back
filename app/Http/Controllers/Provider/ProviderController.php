<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProviderResource;
use App\Models\Comment;
use App\Models\Provider;
use App\Models\Service;
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

    public function comments(Request $request)
    {
        $provider = $request->user()->provider;
        $comments = Comment::whereHas('service', function ($q) use ($provider) {
            $q->where('provider_id', $provider->id);
        })
            ->with([
                'service:id,name',
                'tourist:id,name'
            ])
            ->get();
        return apiSuccess("التعليفات على الخدمات", $comments);
    }

    public function ratings(Request $request)
    {
        $provider = $request->user()->provider;

        $ratings = $provider->services()->withAvg('ratings as avg_rating', 'ratings.rate')->get();
        
        return apiSuccess("التعليفات على الخدمات", $ratings);
    }

    function getCategories(Request $request)
    {

        $categories = $request->user()->provider->categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
            ];
        });

        return apiSuccess("الخدمات التي تقدمها", $categories);
    }

    function updateCategories(Request $request)
    {
        $request->validate([
            'categories' => 'array',
            'categories.*' => 'required|exists:categories,id',
        ]);
        $request->user()->provider->categories()->sync($request->categories);
        return apiSuccess("تم تخزين الخدمات تقدمها");
    }
}
