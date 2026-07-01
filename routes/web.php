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
use App\Http\Controllers\NomineeController;
use App\Http\Controllers\LoanCollectionController;
use App\Http\Controllers\LoanHistoryController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\DepositCategoryController;
use App\Http\Controllers\DepositCollectionController;
use App\Http\Controllers\DepositWithdrawController;
use App\Http\Controllers\LoanUInstallmentController;
use App\Http\Controllers\LoanInstallmentController;

// new loan up 
use App\Http\Controllers\LoanUpCategoryController;
use App\Http\Controllers\LoanUpController;


use App\Http\Controllers\LoanUpInstallmentController;


    Route::get('/loan-history', [LoanHistoryController::class, 'index'])
        ->name('loan-history.index');

    Route::post('/loan-history', [LoanHistoryController::class, 'search'])
        ->name('loan-history.search');
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');


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
        Route::resource('nominees', NomineeController::class);
        Route::resource('loan-collections', LoanCollectionController::class);
        Route::resource('deposit-categories', DepositCategoryController::class);
        Route::resource('deposits', DepositController::class);
        Route::resource('deposit-collections', DepositCollectionController::class);
        Route::resource('deposit-withdraws', DepositWithdrawController::class);

        // new loan up 
        Route::resource('loan-up-categories', LoanUpCategoryController::class);
        Route::resource('loan-ups', LoanUpController::class);
        Route::get('/loan-installments', [LoanInstallmentController::class, 'index'])->name('loan-installments.index');
        Route::post('/loan-installments/search', [LoanInstallmentController::class, 'search']);
        Route::post('/loan-installments/pay', [LoanInstallmentController::class, 'pay']);
        // Route::resource('loan-installments', LoanInstallmentController::class);
 
        Route::resource('loan-u-installments', LoanUInstallmentController::class);

        Route::post('/loan-ups/{id}/approve', [LoanUpController::class, 'approve'])->name('loan-ups.approve');
        Route::post('/loan-ups/{id}/reject', [LoanUpController::class, 'reject'])->name('loan-ups.reject');

         Route::prefix('loanup-installments')->name('loanup.installment.')->group(function () {

            Route::get('/', [LoanUpInstallmentController::class, 'index'])
                ->name('index');

            Route::get('/create/{loan_up_id?}', [LoanUpInstallmentController::class, 'create'])
                ->name('create');

            Route::post('/store', [LoanUpInstallmentController::class, 'store'])
                ->name('store');

            Route::get('/show/{id}', [LoanUpInstallmentController::class, 'show'])
                ->name('show');

            Route::get('/edit/{id}', [LoanUpInstallmentController::class, 'edit'])
                ->name('edit');

            Route::post('/update/{id}', [LoanUpInstallmentController::class, 'update'])
                ->name('update');

            Route::get('/delete/{id}', [LoanUpInstallmentController::class, 'destroy'])
                ->name('destroy');
        });

    
        Route::get('/loan-collections/{loanCollection}/download-pdf', [LoanCollectionController::class, 'downloadPdf'])->name('loan-collections.download-pdf');


    });
    Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
