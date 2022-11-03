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



Route::get('/',[\App\Http\Controllers\PageController::class,'index'])->name('page.index');
Route::get('/detail/{slug}',[\App\Http\Controllers\PageController::class,'detail'])->name('page.detail');
Auth::routes();
Route::get('/category/{slug}',[\App\Http\Controllers\PageController::class,'postByCategory'])->name('page.category');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/post',\App\Http\Controllers\PostController::class);
Route::resource('/category',\App\Http\Controllers\CategoryController::class);
Route::resource('user',\App\Http\Controllers\UserController::class)->middleware('isAdmin');
Route::resource('/photo',\App\Http\Controllers\PhotoController::class);
