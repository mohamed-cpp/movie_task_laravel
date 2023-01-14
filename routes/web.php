<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes...
Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');



Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('movie')->group(function () {
        Route::get('/', [App\Http\Controllers\MovieController::class, 'index'])->name('movie.index');

        Route::get('/create', [App\Http\Controllers\MovieController::class, 'create'])->name('movie.create');
        Route::post('/create', [App\Http\Controllers\MovieController::class, 'store'])->name('movie.store');

        Route::get('/{movie}/edit', [App\Http\Controllers\MovieController::class, 'edit'])->name('movie.edit');
        Route::put('/{movie}/edit', [App\Http\Controllers\MovieController::class, 'update'])->name('movie.update');

        Route::delete('/{movie}/delete', [App\Http\Controllers\MovieController::class, 'destroy'])->name('movie.delete');
    });

    Route::prefix('category')->group(function () {
        Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');

        Route::get('/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');
        Route::post('/create', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');

        Route::get('/{category}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/{category}/edit', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');

        Route::delete('/{category}/delete', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.delete');
    });

    Route::prefix('admin')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');

        Route::get('/create', [App\Http\Controllers\AdminController::class, 'create'])->name('admin.create');
        Route::post('/create', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.store');

        Route::get('/{user}/edit', [App\Http\Controllers\AdminController::class, 'edit'])->name('admin.edit');
        Route::put('/{user}/edit', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.update');

        Route::delete('/{user}/delete', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.delete');
    });

});