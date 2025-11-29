<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/meter/{id}', function ($id) {
    $latest = App\Models\Instantaneous::where('id_meter', $id)
        ->latest('created_at')
        ->first();
    $payload = $latest
        ? json_encode([$latest], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        : '[]';
    return response()->json(['meter' => $payload], 200);
})->name('api.meter.update');
