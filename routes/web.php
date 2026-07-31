<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReservationController;
use Illuminate\Auth\Events\Logout;

Route::get('/',function (){
    return redirect()->route('login');
});
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');
Route::post('/login',[AuthController::class, 'login'])->name('login.store');
Route::post('/logout',[AuthController::class, 'logout'])
 ->middleware('auth')
 ->name('logout');

 Route::middleware('auth')->group(function(){
    Route::get('/events',[EventController::class, 'index'])->name('events.index');
    Route::get('/events/{event}',[EventController::class, 'show'])->name('events.show');
    Route::post('/events/{event}',[ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/mes-billets',[ReservationController::class, 'mine'])->name('reservations.mine');
 });

 Route::get('/admin/events',[EventController::class, 'index'])
  ->middleware(['auth','admin'])
  ->name('admin.events.index');
 Route::get('/admin/events/create',[EventController::class, 'create'])
 ->middleware(['auth','admin'])
 ->name('admin.events.create');
 Route::post('admin/events',[EventController::class, 'store'])
  ->middleware(['auth','admin'])
  ->name('admin.events.store');
 Route::get('/admin/events/{event}/edit',[EventController::class, 'edit'])
  ->middleware(['auth','admin'])
  ->name('admin.events.edit');
 Route::put('/admin/events/{event}',[EventController::class, 'update'])
  ->middleware(['auth','admin'])
  ->name('admin.events.update');
 Route::delete('/admin/events/{event}',[EventController::class, 'destroy'])
  ->middleware(['auth','admin'])
  ->name('admin.events.destroy');
 Route::get('/admin/events/{event}/reservation',[ReservationController::class, 'forEvent'])
  ->middleware(['auth','admin'])
  ->name('admin.reservations.for-event');

