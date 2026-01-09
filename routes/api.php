<?php

use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PreferenceController;
use App\Http\Controllers\provider\NotificationController;
use App\Http\Controllers\Provider\ProviderController;
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
Route::get('categories/tree', [CategoryController::class, 'tree']);
Route::get('/categories', [CategoryController::class , 'index']);

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


Route::fallback(function () {
    return apiError("path is incorrect", [
        'url' => URL::current()
    ]);
});
