<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller( AuthController::class)->group(function(){
    Route::post('/register' ,   'register');
    Route::post('/login' ,   'login');
    Route::post('/logout' ,   'logout')->middleware('auth:sanctum');
});

Route::apiResource('/categories' ,CategoryController::class)->middleware('auth:sanctum');
    

    Route::fallback(function(){
        return apiError("path is incorrect" , [
            'url' => URL::current()
        ]);
    });
