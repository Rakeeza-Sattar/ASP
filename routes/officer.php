<?php
use App\Http\Controllers\Officer\DashboardController;
use App\Http\Controllers\Officer\AppointmentController;
use App\Http\Controllers\Officer\DocumentationController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('officer.dashboard');

// Appointments
Route::prefix('appointments')->name('appointments.')->group(function () {
    Route::get('/', [AppointmentController::class, 'index'])->name('index');
    Route::get('/{appointment}', [AppointmentController::class, 'show'])->name('show');
    Route::post('/{appointment}/start', [AppointmentController::class, 'start'])->name('start');
    Route::post('/{appointment}/complete', [AppointmentController::class, 'complete'])->name('complete');
    Route::get('/{appointment}/document', [DocumentationController::class, 'index'])->name('document');
});

// Documentation
Route::prefix('documentation')->name('documentation.')->group(function () {
    Route::post('/items', [DocumentationController::class, 'storeItem'])->name('items.store');
    Route::post('/items/{item}/files', [DocumentationController::class, 'uploadFile'])->name('files.upload');
    Route::post('/signature', [DocumentationController::class, 'saveSignature'])->name('signature');
    Route::post('/report/generate', [DocumentationController::class, 'generateReport'])->name('report.generate');
});