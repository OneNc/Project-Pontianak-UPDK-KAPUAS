<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MeterController;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\report\LoadProfileController;
use App\Http\Controllers\report\InstantaneousController;

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/meters', [DashboardController::class, 'api_meters'])->name('dashboard.api.meters');
    Route::get('/dashboard/chart', [DashboardController::class, 'api_chart'])->name('dashboard.api.chart');
    Route::post('/dashboard/reconnect', [DashboardController::class, 'api_reconnect'])->name('dashboard.api.reconnect');
    Route::post('/dashboard/reconnect/status', [DashboardController::class, 'api_reconnect_status'])->name('dashboard.api.reconnect.status');
    // Gateway
    Route::get('/gateway', [GatewayController::class, "index"])->name('gateway');
    Route::post('/gateway', [GatewayController::class, "store"])->name('gateway.store');
    Route::get('/gateway/data', [GatewayController::class, "api"])->name('gateway.api');
    // Meter
    Route::get('/meter', [MeterController::class, 'index'])->name('meter');
    Route::post('/meter', [MeterController::class, 'store'])->name('meter.store');
    Route::get('/meter/index/data', [MeterController::class, 'api'])->name('api.meter');
    Route::get('/meter/overview/{id}', [MeterController::class, 'overview'])->name('meter.overview');
    Route::post('/meter/overview/read', [MeterController::class, 'read'])->name('meter.overview.read');
    // Group
    Route::get('/group', [GroupController::class, 'index'])->name('group');
    Route::post('/group', [GroupController::class, 'store'])->name('group.store');
    Route::get('/group/data', [GroupController::class, 'api'])->name('group.api');
    // Report
    Route::get('/report/meter', [ReportController::class, "api_meter"])->name('report.meter.api');
    // Report - instantaneous
    Route::get('/report/instantaneous', [InstantaneousController::class, "index"])->name('report.instantaneous');
    Route::get('/report/instantaneous/data', [InstantaneousController::class, 'api'])->name('report.instantaneous.api');
    Route::post('/report/instantaneous/export/', [InstantaneousController::class, 'export'])->name('report.instantaneous.export');
    // Report - loadprofile
    Route::get('/report/loadprofile', [LoadProfileController::class, "index"])->name('report.loadprofile');
    Route::get('/report/loadprofile/data', [LoadProfileController::class, 'api'])->name('report.loadprofile.api');
    Route::post('/report/loadprofile/export/', [LoadProfileController::class, 'export'])->name('report.loadprofile.export');
    Route::post('/report/loadprofile/read', [LoadProfileController::class, 'read'])->name('report.loadprofile.read');
    // Settings
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
});
