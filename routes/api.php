<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\EventApiController;

Route::post('/login', [AuthApiController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::get('/admin/test', function (Request $request) {
        return response()->json([
            'message' => 'Bienvenue Admin !'
        ]);
    });

});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::post('/events', [EventApiController::class, 'store']);

});

Route::get('/events', [EventApiController::class, 'index']);
