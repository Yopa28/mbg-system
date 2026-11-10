<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;

// Halaman login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

// Proses autentikasi
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Dashboard admin
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});
