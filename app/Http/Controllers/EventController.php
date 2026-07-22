<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    // Liste des événements (accessible à tous les connectés)
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    // Formulaire de création (admin uniquement)
    public function create()
    {
        return view('events.create');
    }

    // Enregistrement d'un nouvel événement
    public function store(StoreEventRequest $request)
    {
        $validated = $request->validated();
        $validated['admin_id'] = auth()->id();

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Événement créé avec succès.');
    }

    // Détail d'un événement (accessible à tous les connectés)
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    // Formulaire d'édition (admin uniquement)
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // Mise à jour
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->validated());

        return redirect()->route('events.index')->with('success', 'Événement modifié avec succès.');
    }

    // Suppression
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Événement supprimé.');
    }
}
