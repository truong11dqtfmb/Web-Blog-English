<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\CategoryController;
use  App\Http\Controllers\PostController;
use  App\Http\Controllers\WebController;

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

//Web
Route::get('/', [WebController::class, 'home'])->name('web');
Route::get('category/{id}', [WebController::class, 'category'])->name('web.category');
Route::get('post/{id}', [WebController::class, 'post'])->name('web.post');
Route::get('search', [WebController::class, 'search'])->name('web.search');


// Admin
Route::group(['prefix' => 'ad'], function () {
    Route::group(['prefix' => 'category'], function () {
        Route::get('', [CategoryController::class, 'index'])->name('ad.category.index');
        Route::get('create', [CategoryController::class, 'create'])->name('ad.category.create');
        Route::post('store', [CategoryController::class, 'store'])->name('ad.category.store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('ad.category.edit');
        Route::put('update/{id}', [CategoryController::class, 'update'])->name('ad.category.update');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('ad.category.delete');
    });
    Route::group(['prefix' => 'post'], function () {
        Route::get('', [PostController::class, 'index'])->name('ad.post.index');
        Route::get('create', [PostController::class, 'create'])->name('ad.post.create');
        Route::post('store', [PostController::class, 'store'])->name('ad.post.store');
        Route::get('show/{id}', [PostController::class, 'show'])->name('ad.post.show');
        Route::get('edit/{id}', [PostController::class, 'edit'])->name('ad.post.edit');
        Route::put('update/{id}', [PostController::class, 'update'])->name('ad.post.update');
        Route::get('delete/{id}', [PostController::class, 'delete'])->name('ad.post.delete');
    });
});