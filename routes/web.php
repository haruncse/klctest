<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
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

Route::get('/product',[ProductController::class,'index'])->name('product');
Route::post('/product',[ProductController::class,'store'])->name('product-create');
Route::get('/product/all', [ProductController::class,'productList'])->name('get-all-product');
Route::post('/modify-product', [ProductController::class,'update'])->name('modify-product');
Route::get('/delete-product/{id}', [ProductController::class,'destroy'])->name('delete-product');

Route::get('/sale',[SaleController::class,'index'])->name('sale');
Route::post('/store-sale',[SaleController::class,'store'])->name('store-sale'); 
