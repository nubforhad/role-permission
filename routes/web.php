<?php

use Illuminate\Support\Facades\Route;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\ThanaController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\LoanCategoryController;
use App\Http\Controllers\InstallmentTypeController;
use App\Http\Controllers\LoanSectionController;
use App\Http\Controllers\MemberController;
   
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
    Route::resource('loan-categories', LoanCategoryController::class);
    Route::resource('installment-types', InstallmentTypeController::class);
    Route::resource('loan-sections', LoanSectionController::class);
    Route::resource('members', MemberController::class);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
