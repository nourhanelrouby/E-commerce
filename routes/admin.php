<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

    Route::controller(AdminController::class)->group(function () {
        // Login
        Route::middleware('guest:admin')->group(function () {
            Route::get('login', 'login')->name('login');
            Route::post('login', 'loginPost')->name('loginPost');
        });
        Route::middleware('auth:admin')->group(function () {
            Route::get('logout', 'logout')->name('logout');
            Route::get('dashboard', 'dashboard')->name('dashboard');
            Route::get('profile', 'profile')->name('profile');
            Route::post('update-profile' ,'updateProfile')->name('updateProfile');
        });
    });
        Route::middleware('auth:admin')->group(function () {

            // Category Routes
            Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
                Route::controller(CategoryController::class)->group(function () {
                    Route::get('index', 'index')->name('index');
                    Route::post('store', 'store')->name('store');
                    Route::put('update/{id}', 'update')->name('update');
                    Route::delete('delete/{id}', 'delete')->name('delete');
                });
            });
            // Products Routes
            Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
                Route::controller(ProductController::class)->group(function () {
                    Route::get('index', 'index')->name('index');
                    Route::post('store', 'store')->name('store');
                    Route::put('update/{id}', 'update')->name('update');
                    Route::delete('delete/{id}', 'delete')->name('delete');
                });
            });

            // Users Routes
            Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
                Route::controller(\App\Http\Controllers\admin\UserController::class)->group(function () {
                    Route::get('index', 'index')->name('index');
                    Route::post('store', 'store')->name('store');
                    Route::put('update/{id}', 'update')->name('update');
                    Route::delete('delete/{id}', 'delete')->name('delete');
                });
            });
        });



