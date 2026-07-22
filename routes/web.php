<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReservationController;

/*
|------------------------------------------------------------------------
| Page d'accueil

*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Authentification
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Routes Étudiant
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Liste des événements
    Route::get('/events', [EventController::class, 'index'])
        ->name('events.index');

    // Détails d'un événement
    Route::get('/events/{event}', [EventController::class, 'show'])
        ->name('events.show');

    // Réserver un événement
    Route::post('/events/{event}/reserve', [ReservationController::class, 'store'])
        ->name('reservations.store');

    // Mes billets
    Route::get('/mes-billets', [ReservationController::class, 'mine'])
        ->name('reservations.mine');
});

/*
|--------------------------------------------------------------------------
| Routes Admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {

        // Gestion des événements
        Route::get('/events', [EventController::class, 'index'])
            ->name('events.index');

        Route::get('/events/create', [EventController::class, 'create'])
            ->name('events.create');

        Route::post('/events', [EventController::class, 'store'])
            ->name('events.store');

        Route::get('/events/{event}/edit', [EventController::class, 'edit'])
            ->name('events.edit');

        Route::put('/events/{event}', [EventController::class, 'update'])
            ->name('events.update');

        Route::delete('/events/{event}', [EventController::class, 'destroy'])
            ->name('events.destroy');

        // Suivi des réservations
        Route::get('/events/{event}/reservations', [ReservationController::class, 'forEvent'])
            ->name('reservations.for-event');
    });
