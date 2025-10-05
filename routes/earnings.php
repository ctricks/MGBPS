<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\OvertimeTypeController;

Route::prefix('earnings')->name('earnings.')->group(function(){
    Route::resource('overtime',OvertimeController::class);
    Route::patch('overtimeapprove/{id}',[OvertimeController::class,'approve'])->name('overtime.approve');
    Route::patch('overtimedecline/{id}',[OvertimeController::class,'decline'])->name('overtime.decline');
    Route::get('overtimefile/{id}',[OvertimeController::class,'filing'])->name('overtime.filing');
    Route::get('overtimefilecancel/{id}',[OvertimeController::class,'cancelfiling'])->name('overtime.cancelfiling');
});
