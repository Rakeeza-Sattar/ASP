<?php

// routes/web.php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    $user = auth()->user();
    
    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('officer')) {
        return redirect()->route('officer.dashboard');
    } elseif ($user->hasRole('homeowner')) {
        return redirect()->route('homeowner.dashboard');
    }
    
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// Payment routes
Route::middleware('auth')->group(function () {
    Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/history', [PaymentController::class, 'getPaymentHistory'])->name('payment.history');
});

// Webhook route (no auth required)
Route::post('/webhooks/square', [PaymentController::class, 'webhook'])->name('webhooks.square');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public appointment booking
Route::post('/appointment/store', [HomeController::class, 'storeAppointment'])->name('appointment.store');
Route::get('/appointment/confirmation', [HomeController::class, 'appointmentConfirmation'])->name('appointment.confirmation');

require __DIR__.'/auth.php';


