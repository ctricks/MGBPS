<?php
use App\Http\Controllers\SummaryAttendanceController;
use App\Http\Controllers\RawAttendanceController;
use App\Http\Controllers\DailyTimeRecordController;
use App\Http\Controllers\RestdayController;
use App\Http\Controllers\WorkScheduleController;
use Illuminate\Support\Facades\Route;

Route::prefix('attendance')->name('attendance.')->group(function(){
        Route::resource('restday',RestdayController::class);
        Route::resource('workschedule',WorkScheduleController::class);
        Route::resource('summary',SummaryAttendanceController::class);
        Route::resource('raw',DailyTimeRecordController::class);
        Route::post('restdayimport', [RestdayController::class,'import'])->name('restday.import');
        Route::post('rawattendanceimport', [DailyTimeRecordController::class,'import'])->name('rawattendance.import');
        Route::post('rawattendancelist', [DailyTimeRecordController::class,'getemployeelist'])->name('rawattendance.list');
        Route::get('rawattendancedownloadtemplate', [DailyTimeRecordController::class,'downloadFileTemplate'])->name('rawattendance.downloadtemplate');       
    });

