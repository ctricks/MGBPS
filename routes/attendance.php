<?php
use App\Http\Controllers\RawAttendanceController;
use App\Http\Controllers\DailyTimeRecordController;
use Illuminate\Support\Facades\Route;

Route::prefix('attendance')->name('attendance.')->group(function(){
        Route::resource('raw',DailyTimeRecordController::class);
        Route::post('rawattendanceimport', [DailyTimeRecordController::class,'import'])->name('rawattendance.import');
        Route::get('rawattendancedownloadtemplate', [DailyTimeRecordController::class,'downloadFileTemplate'])->name('rawattendance.downloadtemplate');       
    });

