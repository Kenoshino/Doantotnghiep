<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
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

Route::get('/', function () {
    return view('admin/home');
});


Route::resource('categories', CategoryController::class);
Route::get('/categories/active/{categories_id}',[CategoryController::class,'active'])->name('active-categories');
Route::get('/categories/unactive/{categories_id}',[CategoryController::class,'unactive'])->name('unactive-categories');

Route::resource('brands', BrandController::class);
Route::get('/brands/active/{brands_id}',[BrandController::class,'active'])->name('active-brands');
Route::get('/brands/unactive/{brands_id}',[BrandController::class,'unactive'])->name('unactive-brands');


Route::resource('products', ProductController::class);
Route::get('/products/active/{products_id}',[ProductController::class,'active'])->name('active-products');
Route::get('/products/unactive/{products_id}',[ProductController::class,'unactive'])->name('unactive-products');
