<?php

use App\Http\Controllers\website\HomePageController;
use App\Http\Controllers\website\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

   // Home Routes

Route::controller(HomePageController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

       // Products Routes
Route::group(['prefix'=>'product' ,'as'=>'product.'],function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get('product-details/{id}', 'productDetails')->name('productDetails');
    });
});
