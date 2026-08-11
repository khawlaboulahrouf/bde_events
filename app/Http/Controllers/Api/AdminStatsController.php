<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;

class AdminStatsController extends Controller
{
    public function index()
    {
        $events = Event::withCount('reservations')
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'titre' => $event->titre,
                    'max_capacity' => $event->places,
                    'bookings_count' => $event->reservations_count,
                    'places_restantes' => $event->places - $event->reservations_count,
                ];
            });

        return response()->json([
            'events' => $events,
        ], 200);
    }
}
