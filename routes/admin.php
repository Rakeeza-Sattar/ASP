<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\PaymentController;
use App\DataTables\AppointmentsDataTable;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Users Management
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}', [UserController::class, 'show'])->name('show');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    Route::patch('/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('toggle-status');
});

// Appointments Management
Route::prefix('appointments')->name('appointments.')->group(function () {
    Route::get('/', [AppointmentController::class, 'index'])->name('index');
    Route::get('/create', [AppointmentController::class, 'create'])->name('create');
    Route::post('/', [AppointmentController::class, 'store'])->name('store');
    Route::get('/{appointment}', [AppointmentController::class, 'show'])->name('show');
    Route::get('/{appointment}/edit', [AppointmentController::class, 'edit'])->name('edit');
    Route::put('/{appointment}', [AppointmentController::class, 'update'])->name('update');
    Route::delete('/{appointment}', [AppointmentController::class, 'destroy'])->name('destroy');
    Route::post('/{appointment}/assign', [AppointmentController::class, 'assignOfficer'])->name('assign');
    Route::patch('/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('update-status');
    Route::get('/stats', [AppointmentController::class, 'getStats'])->name('stats');
});

// Reports Management
Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('index');
    Route::get('/{report}', [ReportController::class, 'show'])->name('show');
    Route::get('/{report}/download', [ReportController::class, 'download'])->name('download');
});

// Payments Management
Route::prefix('payments')->name('payments.')->group(function () {
    Route::get('/', [PaymentController::class, 'index'])->name('index');
    Route::get('/{payment}', [PaymentController::class, 'show'])->name('show');
});

// Officers API endpoints
Route::get('/officers/available', [UserController::class, 'getAvailableOfficers'])->name('officers.available');

// DataTables routes
Route::get('/appointments/data', function (AppointmentsDataTable $dataTable) {
    return $dataTable->render('admin.appointments.index');
})->name('admin.appointments.data');

Route::get('/users/data', function (UsersDataTable $dataTable) {
    return $dataTable->render('admin.users.index');
})->name('admin.users.data');