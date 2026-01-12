<?php

namespace App\Http\Controllers\Tourist;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProviderResource;
use App\Models\Booking;
use App\Models\Provider;
use Illuminate\Http\Request;

class TouristController extends Controller
{
    function getProfile(Request $request)
    {

        $categories = $request->user()->tourist->profiles->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
            ];
        });

        return apiSuccess("الخدمات التي اخترتها سابقاً", $categories);
    }

    function updateProfile(Request $request)
    {
        $request->validate([
            'categories' => 'array',
            'categories.*' => 'required|exists:categories,id',
        ]);
        $request->user()->tourist->profiles()->sync($request->categories);
        return apiSuccess("تم تخزين الخدمات التي ترغب فيها");
    }

    function matchProvider(Request $request)
    {
        $tourist = $request->user()->tourist;

        $categoryIds = $tourist->profiles->pluck('id');

        $providers = Provider::whereHas(
            'categories',
            fn($q) =>
            $q->whereIn('categories.id', $categoryIds)
        )->with('services')->get();


        return apiSuccess("مزودو الخدمة الموافقون",  ProviderResource::collection($providers));
    }

    function booking(Request $request)
    {

        $validated = $request->validate([
            'start_date' => ['nullable', 'date'],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],
            

            'note' => [
                'nullable',
                'string',
                'max:1000',
            ],


            'service_id' => [
                'required',
                'exists:services,id',
            ],
        ]);
        $tourist_id = $request->user()->tourist->id;
        $validated['tourist_id'] = $tourist_id;
        // return $validated;
        Booking::create($validated);

        return apiSuccess("تم تخزين الحجز بنجاح");
    }

    function tourHistory(Request $request)
    {
        $tourist = $request->user()->tourist;
        $bookings = $tourist->bookings()->with('service.provider:id,name')
        ->with('service.ratings' , function($q) use ($tourist){
            return $q->where('ratings.tourist_id', $tourist->id );
        })
        ->with('service.comments' , function($q) use ($tourist){
            return $q->where('comments.tourist_id', $tourist->id );
        })
        ->get();
        return apiSuccess("سجلات حجوزاتك السابقة" , $bookings);
    }

    function rate(Request $request)
    {
        // return $request;
        $validated = $request->validate([

            'rate' => [
                'nullable',
                'integer',
                'between:1,5',
            ],

            'service_id' => [
                'required',
                'exists:services,id',
            ],
        ]);
        $tourist = $request->user()->tourist;
        //بحث عن وجود حجز لهذه الخدمة        
        if (! $tourist->bookings()->where('service_id', $validated['service_id'])->count())
            return apiError(" لا يمكنك تقييم خدمة لم تشترك فيها");

        $rating = $tourist->ratings()->where('service_id', $validated['service_id'])->first();
        //يوجد تقييم سابق ، سنقوم بتعديله 

        if ($rating)
            $tourist->ratings()->updateExistingPivot($validated['service_id'], ['rate' => $validated['rate'],]);
        //لا يوجد تقييم سابق ، سننشئ سجل 
        else
            $tourist->ratings()->attach($validated['service_id'], ['rate' => $validated['rate'],]);

        return apiSuccess("تم تخزين التقييم");
    }


    function comment(Request $request)
    {
        $validated = $request->validate([

            'comment' => [
                'nullable',
                'string',
                'max:200',
            ],

            'type' => [
                'required',
                'in:positive,negative',
            ],

            'service_id' => [
                'required',
                'exists:services,id',
            ],
        ]);
        $tourist = $request->user()->tourist;

        $tourist->comments()->attach($validated['service_id'], [
            'comment' => $validated['comment'],
            'type' => $validated['type'],
        ]);

        return apiSuccess("تم تخزين التعليق");
    }
}
