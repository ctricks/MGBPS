<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\LoanDetailsController;

Route::prefix('deductions')->name('deductions.')->group(function(){
    Route::resource('loans',LoansController::class);
    Route::resource('loandetails',LoanDetailsController::class);
    Route::get('/getloandesc/{id}', [LoansController::class, 'getLoanDesc']);
});
