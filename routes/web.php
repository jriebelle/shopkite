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
    Route::get('/enterprise', [AdminController::class, 'enterprise'])->name('enterprise');
    Route::get('/store-sales', [AdminController::class, 'storeSales'])->name('store_sales');
    Route::get('/blog', [AdminController::class, 'blog'])->name('blog');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
    Route::get('/users', [AdminController::class, 'users'])->name('users');

    // API endpoints
    Route::post('/api/verify', [AdminController::class, 'verifyItem'])->name('api.verify');
    Route::post('/api/products/verify-batch', [AdminController::class, 'verifyProductsBatch'])->name('api.products.verify_batch');
    Route::post('/api/products/unverify', [AdminController::class, 'unverifyProductsBatch'])->name('api.products.unverify');
    Route::post('/api/products/delete', [AdminController::class, 'deleteProduct'])->name('api.products.delete');
    Route::post('/api/products/update', [AdminController::class, 'updateProduct'])->name('api.products.update');
    Route::post('/api/products/create', [AdminController::class, 'createProduct'])->name('api.products.create');
    Route::post('/api/products/import-csv', [AdminController::class, 'importProductsCsv'])->name('api.products.import_csv');

    Route::post('/api/barcodes/verify-batch', [AdminController::class, 'verifyBarcodesBatch'])->name('api.barcodes.verify_batch');
    Route::post('/api/barcodes/unverify', [AdminController::class, 'unverifyBarcodesBatch'])->name('api.barcodes.unverify');
    Route::post('/api/barcodes/delete', [AdminController::class, 'deleteBarcode'])->name('api.barcodes.delete');
    Route::post('/api/barcodes/update', [AdminController::class, 'updateBarcode'])->name('api.barcodes.update');
    Route::post('/api/barcodes/create', [AdminController::class, 'createBarcode'])->name('api.barcodes.create');
    Route::post('/api/barcodes/import-csv', [AdminController::class, 'importBarcodesCsv'])->name('api.barcodes.import_csv');

    Route::post('/api/categories/verify-batch', [AdminController::class, 'verifyCategoriesBatch'])->name('api.categories.verify_batch');
    Route::post('/api/categories/unverify', [AdminController::class, 'unverifyCategoriesBatch'])->name('api.categories.unverify');
    Route::post('/api/categories/delete', [AdminController::class, 'deleteCategory'])->name('api.categories.delete');
    Route::post('/api/categories/update', [AdminController::class, 'updateCategory'])->name('api.categories.update');
    Route::post('/api/categories/create', [AdminController::class, 'createCategory'])->name('api.categories.create');
    Route::post('/api/categories/import-csv', [AdminController::class, 'importCategoriesCsv'])->name('api.categories.import_csv');

    Route::post('/api/manufacturers/verify-batch', [AdminController::class, 'verifyManufacturersBatch'])->name('api.manufacturers.verify_batch');
    Route::post('/api/manufacturers/unverify', [AdminController::class, 'unverifyManufacturersBatch'])->name('api.manufacturers.unverify');
    Route::post('/api/manufacturers/delete', [AdminController::class, 'deleteManufacturer'])->name('api.manufacturers.delete');
    Route::post('/api/manufacturers/update', [AdminController::class, 'updateManufacturer'])->name('api.manufacturers.update');
    Route::post('/api/manufacturers/create', [AdminController::class, 'createManufacturer'])->name('api.manufacturers.create');
    Route::post('/api/manufacturers/import-csv', [AdminController::class, 'importManufacturersCsv'])->name('api.manufacturers.import_csv');
    Route::post('/api/enterprise/capture', [AdminController::class, 'captureEnterpriseLead'])->name('api.enterprise.capture');
    Route::post('/api/enterprise/status', [AdminController::class, 'updateEnterpriseLeadStatus'])->name('api.enterprise.status');
    Route::post('/api/enterprise/delete', [AdminController::class, 'deleteEnterpriseLead'])->name('api.enterprise.delete');
    Route::post('/api/users/permission', [AdminController::class, 'toggleUserPermission'])->name('api.user.permission');
    Route::post('/api/users/delete', [AdminController::class, 'deleteUser'])->name('api.user.delete');
    Route::post('/api/users/create', [AdminController::class, 'createUser'])->name('api.user.create');
});




