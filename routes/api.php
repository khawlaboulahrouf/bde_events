<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\EventApiController;
use App\Http\Controllers\Api\BookingApiController;
use App\Http\Controllers\Api\AdminStatsController;

Route::post('/login', [AuthApiController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::get('/admin/events/stats', [AdminStatsController::class, 'index']);
    Route::get('/admin/test', function (Request $request) {
        return response()->json([
            'message' => 'Bienvenue Admin !'
        ]);
    });
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::post('/events', [EventApiController::class, 'store']);
    Route::put('/events/{event}', [EventApiController::class, 'update']);
    Route::delete('/events/{event}', [EventApiController::class, 'destroy']);
});



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/events', [EventApiController::class, 'index']);
    Route::get('/events/{event}', [EventApiController::class, 'show']);

    Route::post('/events/{event}/book', [BookingApiController::class, 'book']);
    Route::get('/user/tickets', [BookingApiController::class, 'tickets']);
    Route::post('/logout', [AuthApiController::class, 'logout']);
});
