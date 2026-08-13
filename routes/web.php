<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes — ShopKite Application
|--------------------------------------------------------------------------
*/

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

