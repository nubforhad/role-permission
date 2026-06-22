<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\ThanaController;
use App\Http\Controllers\BranchController;
   
Route::get('/', function () {
    return view('welcome');
});
  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('districts', DistrictController::class);
    Route::resource('thanas', ThanaController::class);
    Route::resource('branches', BranchController::class);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
