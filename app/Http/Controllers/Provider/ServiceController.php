<?php

namespace App\Http\Controllers\Provider;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();

        return apiSuccess('إدارة الخدمات', $services);

    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'identifier' => 'required|string:50',
            'details' => 'nullable|array',
        ]);

        $data['provider_id'] = $request->user()->provider->id;

        $service = Service::create($data);
        return apiSuccess('تم إضافة الخدمة بنجاح' , ['service' => $service], 201);            
    }
        

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name' => 'sometimes|string:50',
            'identifier' => 'sometimes|string:50',
            'details' => 'sometimes|array:50',
        ]);
        
        $service->update($data);
        return apiSuccess('تم تعديل الخدمة بنجاح' , $service);

    }

    /**
     * show the specified resource.
     */
    public function show(Service $service)
    {
        return apiSuccess('بيانات الخدمة' , $service);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return apiSuccess('تم حذف الخدمة بنجاح');
    }
}
