<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| Web Routes — ShopKite Application
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\AdminController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/store', [PageController::class, 'store'])->name('store');
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
Route::get('/ibr', [PageController::class, 'ibr'])->name('ibr');
Route::get('/agent', [PageController::class, 'agent'])->name('agent');
Route::get('/handbook', [PageController::class, 'handbook'])->name('handbook');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/invoice', [PageController::class, 'invoice'])->name('invoice');
Route::get('/recommended-devices', [PageController::class, 'devices'])->name('devices');
Route::get('/order-success', [PageController::class, 'orderSuccess'])->name('order.success');
Route::get('/store-variant', [PageController::class, 'storeVariant'])->name('store.variant');
Route::get('/stores', [PageController::class, 'storesList'])->name('stores.index');
Route::get('/nigeria', [PageController::class, 'storesList'])->name('stores.nigeria');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/pricing', [PageController::class, 'pricing'])->name('pricing');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/barcodes', [AdminController::class, 'barcodes'])->name('barcodes');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::get('/manufacturers', [AdminController::class, 'manufacturers'])->name('manufacturers');
    Route::get('/faqs', [AdminController::class, 'faqs'])->name('faqs');
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('transactions');
    Route::get('/merchants', [AdminController::class, 'merchants'])->name('merchants');
    Route::get('/store-sales', [AdminController::class, 'storeSales'])->name('store_sales');
    Route::get('/blog', [AdminController::class, 'blog'])->name('blog');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
    Route::get('/users', [AdminController::class, 'users'])->name('users');

    // API endpoints
    Route::post('/api/verify', [AdminController::class, 'verifyItem'])->name('api.verify');
    Route::post('/api/users/permission', [AdminController::class, 'toggleUserPermission'])->name('api.user.permission');
    Route::post('/api/users/delete', [AdminController::class, 'deleteUser'])->name('api.user.delete');
    Route::post('/api/users/create', [AdminController::class, 'createUser'])->name('api.user.create');
});




