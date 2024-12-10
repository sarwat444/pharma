<?php

use App\Http\Controllers\Web\Admin\{
    Admin\MedcineController,
    Admin\DashboardController,
    Admin\InnvoiceController ,
    Admin\CosmaticsController ,
    Admin\MedicineNeedController

};
use App\Http\Controllers\Web\Auth\Admin\{ForgetPasswordController, LoginController, NewPasswordController};
use Illuminate\Support\Facades\Route;


const PUBLIC_PATH = 'public/';
const ASSET_PATH =  'public/';

/** admin auth routes */
Route::controller(LoginController::class)->prefix('admins')->group(function () {
    Route::get('login', 'create')->name('admins.login')->middleware('guest:admin');
    Route::post('login', 'store')->middleware('throttle:5,1');
    Route::post('logout', 'destroy')->name('admins.logout')->middleware('auth:admin');
});

/** admin reset password routes */
Route::controller(ForgetPasswordController::class)->prefix('admins')->middleware('guest:admin')->group(function () {
    Route::get('forget-password', 'create')->name('admins.password.request');
    Route::post('forget-password', 'store')->name('admins.password.email')->middleware('throttle:5,1');
});

/** admin new password routes */
Route::controller(NewPasswordController::class)->prefix('admins')->middleware('guest:admin')->group(function () {
    Route::get('reset-password/{token}', 'create')->name('admins.password.reset');
    Route::post('reset-password', 'store')->name('admins.password.update');
});

/** admin dashboard routes */
Route::group(['prefix' => 'admins/dashboard', 'middleware' => 'auth:admin', 'as' => 'dashboard.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    //الكليات
// Correct routing for store, update, and edit actions
    Route::resource('medcine', MedcineController::class);
    Route::get('medicines/data', [MedcineController::class, 'getMedicinesData'])->name('medicines.data');
    Route::post('/medcine/store', [MedcineController::class, 'store'])->name('medcine.store');
    Route::put('/medcine/update/{medcine}', [MedcineController::class, 'update'])->name('medcine.update');
    Route::get('/medcine/edit/{id}', [MedcineController::class, 'edit'])->name('medcine.edit');

    Route::get('medicines/list', [MedcineController::class, 'list'])->name('medicines.list');


    Route::get('invoices', [InnvoiceController::class, 'index'])->name('invoices.index');

    // Route for fetching invoice data for DataTables
    Route::get('invoices/data', [InnvoiceController::class, 'data'])->name('invoices.data');

    // Route for storing new invoice
    Route::post('invoices', [InnvoiceController::class, 'store'])->name('invoices.store');

    // Route for updating an existing invoice
    Route::put('invoices/{id}', [InnvoiceController::class, 'update'])->name('invoices.update');


    Route::get('invoices/add_invoice', [InnvoiceController::class, 'add_invoice'])->name('invoices.add_invoice');

    Route::get('/medicines/search', [InnvoiceController::class, 'search'])->name('medicines.search');

    Route::post('/dashboard/medicines/update-quantity', [InnvoiceController::class, 'updateQuantity'])->name('medicines.updatequinity');

    Route::get('/statistics' , [MedcineController::class, 'statistics'])->name('statistics') ;


    Route::resource('cosmatics', CosmaticsController::class);

    Route::get('cosmatics/data', [CosmaticsController::class, 'getCosmaticasData'])->name('cosmatics.data');

    Route::post('/cosmatics/store', [CosmaticsController::class, 'store'])->name('cosmatics.store');

    Route::put('/cosmatics/update/{medcine}', [CosmaticsController::class, 'update'])->name('cosmatics.update');

    Route::get('/cosmatics/edit/{id}', [CosmaticsController::class, 'edit'])->name('cosmatics.edit');


    Route::get('/medicine-needs/data', [MedicineNeedController::class, 'getMedicineNeeds'])->name('medicine-needs.data');
    Route::post('/medicine-needs/store', [MedicineNeedController::class, 'store'])->name('store-needs');
    Route::put('/medicine-needs/update/{medicineNeed}', [MedicineNeedController::class, 'update'])->name('updated-needs');
    Route::delete('/medicine-needs/delete/{medicineNeed}', [MedicineNeedController::class, 'destroy'])->name('delete-needs');


});



