<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryTreeResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return apiSuccess('كافة الخدمات ', $categories);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
        ]);
        $category = Category::create($validated);
        return apiSuccess('تم إضافة الخدمة بنجاح', $category);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
        ]);
        $category->update($validated);
        return apiSuccess('تم تعديل الخدمة بنجاح', $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return apiSuccess('تم حذف الخدمة بنجاح');
    }

    public function tree()
    {
        $categories = Category::whereNull('category_id')
            ->with(['childrenRecursive', 'providers'])
            ->get();


        return apiSuccess("categories tree", CategoryTreeResource::collection($categories));
    }
}
