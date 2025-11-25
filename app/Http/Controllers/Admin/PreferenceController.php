<?php

namespace App\Http\Controllers\Admin;

use App\Models\Preference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $preferences = Preference::all();

        return apiSuccess('كافة التفضيلات ', $preferences);

    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
        ]);
        $preference = Preference::create($validated);
        return apiSuccess('تم إضافة المفضلة بنجاح' , $preference);
    }
        

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Preference $preference)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
        ]);
        $preference->update($validated);
        return apiSuccess('تم تعديل المفضلة بنجاح' , $preference);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Preference $preference)
    {
        $preference->delete();
        return apiSuccess('تم حذف المفضلة بنجاح');
    }
}
