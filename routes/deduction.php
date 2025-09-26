<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\LoanDetailsController;
use App\Http\Controllers\DeductionDetailsController;

Route::prefix('deductions')->name('deductions.')->group(function(){
    Route::resource('loans',LoansController::class);
    Route::resource('loandetails',LoanDetailsController::class);
    Route::resource('deductiondetails',DeductionDetailsController::class);
    Route::patch('loanapprove/{id}',[LoansController::class,'approve'])->name('loan.approve');
    Route::patch('loandecline/{id}',[LoansController::class,'decline'])->name('loan.decline');
    Route::get('/getloandesc/{id}', [LoansController::class, 'getLoanDesc']);
    Route::post('/deductionlist/{empcode}',[LoanDetailsController::class,'getDeductions'])->name('loans.list');
    Route::post('loanlist',[LoansController::class,'getLoans'])->name('loans.list');
});
