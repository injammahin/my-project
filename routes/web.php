<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\LandingPageController;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\SettingController;

use App\Http\Controllers\Admin\LandingController;
use App\Http\Controllers\Admin\LandingProductController;
use App\Http\Controllers\Admin\LandingIngredientController;
use App\Http\Controllers\Admin\LandingTestimonialController;
use App\Http\Controllers\PageController; // Ensure you have the controller for handling these routes
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| FRONTEND
|--------------------------------------------------------------------------
*/

// Route for "About Us"
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
// Route for "Products"
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/products/{product}', [PageController::class, 'productDetails'])->name('products.show');
// Route for "Blog"
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [PageController::class, 'blogDetails'])->name('blog.show');
// Route for "Contact Us"
Route::get('/contact', [PageController::class, 'contact'])->name('contact');// ✅ Only ONE homepage route (remove duplicate Route::get('/'...) )
Route::get('/', [LandingPageController::class, 'show'])->name('landing');

Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::post('/track', [TrackController::class, 'store'])->name('track.store');


/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');


/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['admin'])
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Settings
        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

        // Orders
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/export', [AdminOrderController::class, 'export'])->name('orders.export');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');
        Route::post('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');

        // Analytics
        Route::get('/analytics', [AnalyticsController::class, 'dashboard'])->name('analytics');
        Route::get('/analytics/events', [AnalyticsController::class, 'events'])->name('analytics.events');
        Route::get('/analytics/session/{visitor}', [AnalyticsController::class, 'session'])->name('analytics.session');
        Route::get('/analytics/map', [AnalyticsController::class, 'map'])->name('analytics.map');
        Route::delete('/analytics/reset', [AnalyticsController::class, 'reset'])->name('analytics.reset');

        // Landing Builder
        Route::get('/landing', [LandingController::class, 'edit'])->name('landing.edit');
        Route::post('/landing', [LandingController::class, 'update'])->name('landing.update');

        Route::resource('/landing/products', LandingProductController::class)
            ->names('landing.products');

        Route::resource('/landing/ingredients', LandingIngredientController::class)
            ->names('landing.ingredients');

        Route::resource('/landing/testimonials', LandingTestimonialController::class)
            ->names('landing.testimonials');
    });
