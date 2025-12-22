<?php

use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PreferenceController;

use App\Http\Controllers\Provider\ServiceController;
use App\Http\Controllers\Tourist\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {
    Route::post('/register',   'register');
    Route::post('/login',   'login');
    Route::post('/logout',   'logout')->middleware('auth:sanctum');
});
Route::get('/countries', [SettingController::class, 'countries']);


Route::middleware(['auth:sanctum', 'user-type:admin'])->prefix('admin')->group(function () {
    Route::apiResource('/preferences', PreferenceController::class);
    Route::apiResource('/categories', CategoryController::class);

    Route::get('/providers', [AdminController::class, 'getProviders']);
    Route::patch('/providers/{provider}', [AdminController::class, 'toggleState']);

    Route::get('/totals', [AdminController::class, 'totals']);
});

Route::middleware(['auth:sanctum', 'user-type:provider'])->prefix('provider')->group(function () {
    Route::apiResource('/services', ServiceController::class);
});


Route::fallback(function () {
    return apiError("path is incorrect", [
        'url' => URL::current()
    ]);
});
