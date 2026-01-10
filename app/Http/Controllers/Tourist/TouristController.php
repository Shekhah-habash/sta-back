<?php

namespace App\Http\Controllers\Tourist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Support\Facades\DB;

use function PHPSTORM_META\map;

class TouristController extends Controller
{
    function getProfile(Request $request)
    {

        $categories = $request->user()->tourist->categories->map(function ($category) {
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
        $request->user()->tourist->categories()->sync($request->categories);
        return apiSuccess("تم تخزين الخدمات التي ترغب فيها");
    }
}
