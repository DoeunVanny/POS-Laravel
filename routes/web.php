<?php

use App\Http\Controllers\categoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\salesController;
use App\Http\Controllers\PrintController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout');
});


Route::resource('/category' , categoryController::class);
Route::resource('/brand' , BrandController::class);
Route::resource('/product' , ProductsController::class);

Route::resource('/sale' , salesController::class);
Route::post('/search', [ salesController::class,'search'])->name('search');
Route::post('/sales_add', [ salesController::class,'store'])->name('sales_add');

Route::get('/print/form{last_id}',[PrintController::class,'showPrintForm'])->name('print.form');
