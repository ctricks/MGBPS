<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\OvertimeTypeController;

Route::prefix('earnings')->name('earnings.')->group(function(){
    Route::resource('overtime',OvertimeController::class);
    
});
