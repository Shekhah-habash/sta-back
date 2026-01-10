<?php

use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PreferenceController;
use App\Http\Controllers\provider\NotificationController;
use App\Http\Controllers\Provider\ProviderController;
use App\Http\Controllers\Provider\ServiceController;
use App\Http\Controllers\Tourist\SettingController;
use App\Http\Controllers\Tourist\TouristController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/** Auth */
Route::controller(AuthController::class)->group(function () {
    Route::post('/register',   'register');
    Route::post('/login',   'login');
    Route::post('/logout',   'logout')->middleware('auth:sanctum');
});

/** guest */
Route::get('/countries', [SettingController::class, 'countries']);
Route::get('/provinces', [SettingController::class, 'provinces']);
Route::get('categories/tree', [CategoryController::class, 'tree']);

Route::get('/categories', [CategoryController::class , 'index']);
Route::get('/categories/top-level', [CategoryController::class , 'topLevel']);

Route::middleware(['auth:sanctum', 'user-type:admin'])->prefix('admin')->group(function () {
    Route::apiResource('/preferences', PreferenceController::class);
    Route::apiResource('/categories', CategoryController::class);

    Route::get('/providers', [AdminController::class, 'getProviders']);
    Route::patch('/accept-provider/{provider}', [AdminController::class, 'acceptProvider']);

    Route::get('/totals', [AdminController::class, 'totals']);
});

Route::middleware(['auth:sanctum', 'user-type:provider'])->prefix('provider')->group(function () {
    Route::get('/getInfo', [ProviderController::class , 'getInfo']);
    
    Route::apiResource('/services', ServiceController::class);
    
    Route::get('/notifications', [NotificationController::class , 'index']);
    Route::get('/notifications/unread-count', [NotificationController::class , 'unreadCount']);
    Route::patch('/notifications/mark-as-read', [NotificationController::class , 'markAsRead']);
});

Route::middleware(['auth:sanctum', 'user-type:tourist'])->prefix('tourist')->group(function () {
    Route::get('/profile', [TouristController::class, 'getProfile']);
    Route::post('/profile', [TouristController::class, 'updateProfile']);

});

Route::fallback(function () {
    return apiError("path is incorrect", [
        'url' => URL::current()
    ]);
});
