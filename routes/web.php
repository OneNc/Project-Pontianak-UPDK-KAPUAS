<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('home'))->name('dashboard');
Route::get('/gateway', fn() => view('gateway.index'))->name('gateway');
