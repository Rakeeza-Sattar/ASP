<?php

use App\Http\Controllers\Officer\DashboardController;
use App\Http\Controllers\Officer\AppointmentController;
use App\Http\Controllers\Officer\DocumentationController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Appointments
Route::prefix('appointments')->name('appointments.')->group(function () {
    Route::get('/', [AppointmentController::class, 'index'])->name('index');
    Route::get('/{appointment}', [AppointmentController::class, 'show'])->name('show');
    Route::post('/{appointment}/start', [AppointmentController::class, 'start'])->name('start');
    Route::get('/{appointment}/document', [AppointmentController::class, 'document'])->name('document');
});

// Item Documentation
Route::prefix('items')->name('items.')->group(function () {
    Route::get('/', [DocumentationController::class, 'index'])->name('index');
    Route::get('/{appointment}/create', [DocumentationController::class, 'create'])->name('create');
    Route::post('/{appointment}', [DocumentationController::class, 'store'])->name('store');
});
