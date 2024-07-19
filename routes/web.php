<?php

use App\Http\Controllers\website\FavoriteController;
use App\Http\Controllers\website\HomePageController;
use App\Http\Controllers\website\ProductController;
use App\Http\Controllers\website\UserController;
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

// USer Routes
Route::controller(UserController::class)->group(function () {
    Route::middleware('guest:user')->group(function () {
        Route::get('register', 'register')->name('register');
        Route::post('sign-up', 'signUp')->name('signUp');
        Route::get('login', 'login')->name('login');
        Route::post('sign-in', 'signIn')->name('signIn');
    });

    Route::middleware('auth:user')->group(function () {
        Route::get('logout', 'logout')->name('logout');
        Route::get('profile', 'profile')->name('profile');
        Route::post('update-profile', 'updateProfile')->name('updateProfile');
    });
});

// Products Routes
Route::group(['prefix'=>'product' ,'as'=>'product.'],function () {
    // Products
    Route::controller(ProductController::class)->group(function () {
        Route::get('product-details/{id}', 'productDetails')->name('productDetails');
    });
    Route::middleware('auth:user')->group(function () {
        // Favorite Products
        Route::controller(FavoriteController::class)->group(function () {
            Route::post('add-favorite', 'addFavorite')->name('addFavorite');
            Route::get('user-favorites', 'userFavorites')->name('userFavorites');
        });

    });
});



