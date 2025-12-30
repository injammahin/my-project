<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\TrackController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/order', [OrderController::class, 'store']);
Route::post('/track', [TrackController::class, 'store']);

/* Admin Auth */
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

/* Admin Panel */
Route::middleware(['admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/orders', [AdminOrderController::class, 'index'])
        ->name('admin.orders.index');

    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])
        ->name('admin.orders.show');

    Route::post('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
        ->name('admin.orders.status');
    Route::get('/analytics', [AnalyticsController::class, 'dashboard']);
    Route::get('/analytics/events', [AnalyticsController::class, 'events']);
    Route::get('/analytics/session/{visitor}', [AnalyticsController::class, 'session']);
});
Route::middleware(['admin'])->prefix('admin/analytics')->group(function () {
    Route::get('/', [AnalyticsController::class,'dashboard']);
    Route::get('/events', [AnalyticsController::class,'events']);
    Route::get('/session/{visitor}', [AnalyticsController::class,'session']);
});