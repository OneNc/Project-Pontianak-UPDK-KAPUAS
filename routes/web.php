<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MeterController;
use App\Http\Controllers\DashboardController;

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/meters/status', [DashboardController::class, 'api_meters_status'])->name('api.dashboard.meters.status');
    Route::get('/gateway', fn() => view('gateway.index'))->name('gateway');
    Route::get('/meter', [MeterController::class, 'index'])->name('meter');
    Route::post('/meter', [MeterController::class, 'store'])->name('meter.store');
    Route::get('/meter/index/data', [MeterController::class, 'api'])->name('api.meter');
    Route::get('/meter/overview/{id}', [MeterController::class, 'overview'])->name('meter.overview');
    Route::post('/meter/overview/{id}/read', [MeterController::class, 'read'])->name('meter.overview.read');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
// Route::get('/login', fn() => view('auth.login'))->name('login');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
});
