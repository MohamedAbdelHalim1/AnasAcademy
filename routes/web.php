<?php

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



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('log.http')->name('show_products');  //Apply the middleware to a specific route.
Route::get('/create_product', [App\Http\Controllers\HomeController::class, 'create'])->name('create');
Route::post('/store_product', [App\Http\Controllers\HomeController::class, 'store'])->name('store');

/* 
Implement a route parameter and retrieve its value in the 
controller
*/

Route::get('/edit_product/{id}' , [App\Http\Controllers\HomeController::class , 'edit_product'])->name('edit_product');
Route::post('/upload_product/{id}', [App\Http\Controllers\HomeController::class, 'upload'])->name('upload');
Route::post('/delete_product/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('destroy');

/* 
routes for Implement a query to fetch all products with a price greater 
than a specified amount.
*/

Route::get('/filter_product', [App\Http\Controllers\HomeController::class, 'filter'])->name('filter');
Route::post('/filter_product', [App\Http\Controllers\HomeController::class, 'search'])->name('search');

/* 
Routes for online payment (stripe integration)
*/

Route::post('/checkout/{id}' , [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');
Route::get('/success' , [App\Http\Controllers\HomeController::class, 'success'])->name('checkout.success');
Route::get('/cancel' , [App\Http\Controllers\HomeController::class, 'cancel'])->name('checkout.cancel');
Route::post('/webhook' , [App\Http\Controllers\HomeController::class, 'webhook'])->name('checkout.webhook');
// we will disable csrf from /webhook thorw App\Http\Middelware\VerifyCsrfToken