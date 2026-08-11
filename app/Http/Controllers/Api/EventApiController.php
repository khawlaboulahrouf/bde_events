<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventApiController extends Controller
{
    public function __construct(
        private EventService $eventService
    ) {
    }

    public function index()
    {
        $events = $this->eventService->getAllEvents();

        return response()->json([
            'events' => $events
        ], 200);
    }

    public function show(Event $event)
    {
        $event = $this->eventService->getEvent($event);

        return response()->json([
            'event' => $event
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

        $event = $this->eventService->createEvent(
            $request->user(),
            $validated
        );

        return response()->json([
            'message' => 'Événement créé avec succès.',
            'event' => $event,
        ], 201);
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'titre' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'date' => 'sometimes|required|date',
            'heure' => 'sometimes|required',
            'lieu' => 'sometimes|required|string|max:255',
            'prix' => 'sometimes|required|numeric|min:0',
            'places' => 'sometimes|required|integer|min:1',
        ]);

        $event = $this->eventService->updateEvent(
            $event,
            $validated
        );

        return response()->json([
            'message' => 'Événement modifié avec succès.',
            'event' => $event
        ], 200);
    }

    public function destroy(Event $event)
    {
        $this->eventService->deleteEvent($event);

        return response()->json([
            'message' => 'Événement supprimé avec succès.'
        ], 200);
    }
}
