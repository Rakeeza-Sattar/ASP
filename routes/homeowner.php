<?php
use App\Http\Controllers\Homeowner\DashboardController;
use App\Http\Controllers\Homeowner\AppointmentController;
use App\Http\Controllers\Homeowner\ItemController;
use App\Http\Controllers\Homeowner\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('homeowner.dashboard');

// Appointments
Route::prefix('appointments')->name('appointments.')->group(function () {
    Route::get('/', [AppointmentController::class, 'index'])->name('index');
    Route::get('/create', [AppointmentController::class, 'create'])->name('create');
    Route::post('/', [AppointmentController::class, 'store'])->name('store');
    Route::get('/{appointment}', [AppointmentController::class, 'show'])->name('show');
    Route::get('/{appointment}/edit', [AppointmentController::class, 'edit'])->name('edit');
    Route::put('/{appointment}', [AppointmentController::class, 'update'])->name('update');
});

// Items
Route::prefix('items')->name('items.')->group(function () {
    Route::get('/', [ItemController::class, 'index'])->name('index');
    Route::get('/{item}', [ItemController::class, 'show'])->name('show');
});

// Reports
Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('index');
    Route::get('/{report}', [ReportController::class, 'show'])->name('show');
    Route::get('/{report}/download', [ReportController::class, 'download'])->name('download');
});


