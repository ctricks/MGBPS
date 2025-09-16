<?php
use App\Http\Controllers\SummaryAttendanceController;
use App\Http\Controllers\RawAttendanceController;
use App\Http\Controllers\DailyTimeRecordController;
use App\Http\Controllers\RestdayController;
use App\Http\Controllers\WorkScheduleController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\PayrollController;
use Illuminate\Support\Facades\Route;

Route::prefix('attendance')->name('attendance.')->group(function(){
        Route::resource('restday',RestdayController::class);
        Route::resource('workschedule',WorkScheduleController::class);
        Route::resource('summary',SummaryAttendanceController::class);
        Route::resource('raw',DailyTimeRecordController::class);
        Route::resource('leavetype',LeaveTypeController::class);
        Route::resource('leave',LeaveController::class);
        Route::resource('holiday',HolidayController::class);
        Route::get('processpayroll/{cutoff}/{empcode}',[DailyTimeRecordController::class,'processpayroll'])->name('raw.processpayroll');
        Route::patch('leaveapprove/{id}',[LeaveController::class,'approve'])->name('leave.approve');
        Route::patch('leavedecline/{id}',[LeaveController::class,'decline'])->name('leave.decline');
        Route::get('restdayimport', [RestdayController::class,'import'])->name('restday.import');
        Route::post('holidayimport', [HolidayController::class,'import'])->name('holiday.import');
        Route::post('rawattendanceimport', [DailyTimeRecordController::class,'import'])->name('rawattendance.import');
        Route::post('rawattendancelist', [DailyTimeRecordController::class,'getemployeelist'])->name('rawattendance.list');
        Route::post('summaryattendancelist', [SummaryAttendanceController::class,'getemployeelist'])->name('summaryattendance.list');
        Route::get('summary/{cutoff}/{empcode}', [SummaryAttendanceController::class,'getemployeesummary'])->name('summaryattendance.view');
        Route::get('rawattendancedownloadtemplate', [DailyTimeRecordController::class,'downloadFileTemplate'])->name('rawattendance.downloadtemplate'); 
        Route::get('holidayattendancedownloadtemplate', [HolidayController::class,'downloadFileTemplate'])->name('holiday.downloadtemplate');      
    });

Route::prefix('payroll')->name('payroll.')->group(function(){
    Route::resource('payroll',PayrollController::class);
    Route::post('summarypayrolllist', [PayrollController::class,'getemployeelist'])->name('summarypayroll.list');
    Route::get('summary/{cutoff}/{empcode}', [PayrollController::class,'getemployeesummary'])->name('summarypayroll.view');
});    

