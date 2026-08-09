<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventApiController extends Controller
{
    public function index()
{
    $events = Event::with('admin')
        ->withCount('reservations')
        ->latest()
        ->get();

    return response()->json([
        'events' => $events
    ], 200);
}



    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'heure' => 'required',
            'lieu' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'places' => 'required|integer|min:1',
        ]);

        $event = Event::create([
            'admin_id' => $request->user()->id,
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'heure' => $validated['heure'],
            'lieu' => $validated['lieu'],
            'prix' => $validated['prix'],
            'places' => $validated['places'],
        ]);

        return response()->json([
            'message' => 'Événement créé avec succès.',
            'event' => $event,
        ], 201);
    }


}
