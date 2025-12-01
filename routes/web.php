<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MeterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\report\InstantaneousController;
use App\Http\Controllers\report\LoadProfileController;
use App\Http\Controllers\Report\ReportController;

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/meters', [DashboardController::class, 'api_meters'])->name('dashboard.api.meters');
    Route::get('/dashboard/chart', [DashboardController::class, 'api_chart'])->name('dashboard.api.chart');
    Route::post('/dashboard/reconnect', [DashboardController::class, 'api_reconnect'])->name('dashboard.api.reconnect');
    Route::post('/dashboard/reconnect/status', [DashboardController::class, 'api_reconnect_status'])->name('dashboard.api.reconnect.status');

    Route::get('/gateway', fn() => view('gateway.index'))->name('gateway');
    // Meter
    Route::get('/meter', [MeterController::class, 'index'])->name('meter');
    Route::post('/meter', [MeterController::class, 'store'])->name('meter.store');
    Route::get('/meter/index/data', [MeterController::class, 'api'])->name('api.meter');
    Route::get('/meter/overview/{id}', [MeterController::class, 'overview'])->name('meter.overview');
    Route::post('/meter/overview/{id}/read', [MeterController::class, 'read'])->name('meter.overview.read');

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
    Route::post('/report/loadprofile/{id}/read', [LoadProfileController::class, 'read'])->name('report.loadprofile.read');
    Route::get('/report/loadprofile/{id}/update', [LoadProfileController::class, 'api_update'])->name('report.loadprofile.api.update');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
// Route::get('/login', fn() => view('auth.login'))->name('login');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
});
