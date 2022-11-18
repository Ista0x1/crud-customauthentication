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

Route::get('/', [App\Http\Controllers\ProductController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group( function() {
	Route::get('products', [App\Http\Controllers\ProductController::class, 'add']);
	Route::post('insert-product', [App\Http\Controllers\ProductController::class, 'insert']);

	Route::get('edit/{id}', [App\Http\Controllers\ProductController::class, 'edit']);
	Route::put('update-product/{id}', [App\Http\Controllers\ProductController::class, 'update']);
	Route::get('delete/{id}', [App\Http\Controllers\ProductController::class, 'delete']);
});