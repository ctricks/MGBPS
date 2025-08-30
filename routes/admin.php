<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCateoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CivilStatusController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeStatusController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard',[ProfileController::class,'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware(['role:admin'])->group(function(){
        Route::resource('user',UserController::class);
        Route::resource('employee',EmployeeController::class);
        Route::resource('role',RoleController::class);
        Route::resource('permission',PermissionController::class);
        Route::resource('category',CategoryController::class);
        Route::resource('subcategory',SubCateoryController::class);
        Route::resource('collection',CollectionController::class);
        Route::resource('product',ProductController::class);
        Route::resource('civilstatus',CivilStatusController::class);
        Route::resource('gender',GenderController::class);
        Route::resource('position',PositionController::class);
        Route::resource('department',DepartmentController::class);
        Route::resource('employeestatus',EmployeeStatusController::class);
        Route::get('/get-employee-data', [EmployeeController::class, 'getEmployeeData'])->name('employee.search');
        Route::post('employeeimport', [EmployeeController::class,'import'])->name('employee.import');
        Route::get('employeedownloadtemplate', [EmployeeController::class,'downloadFileTemplate'])->name('employee.downloadtemplate');
        Route::get('/get/subcategory',[ProductController::class,'getsubcategory'])->name('getsubcategory');
        Route::get('/remove-external-img/{id}',[ProductController::class,'removeImage'])->name('remove.image');
    });
});
