<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // Liste des événements
    public function index()
    {
        $events = Event::all();

        if (Auth::user()->role === 'admin') {
            return view('admin.events.index', compact('events'));
        }

        return view('events.index', compact('events'));
    }

    // Formulaire de création
    public function create()
    {
        return view('admin.events.create');
    }

    // Enregistrer un événement
    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();

        $data['admin_id'] = Auth::id();

        Event::create($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Événement créé avec succès.');
    }

    // Détails d'un événement
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    // Formulaire de modification
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    // Mise à jour
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->validated());

        return redirect()->route('admin.events.index')
            ->with('success', 'Événement modifié avec succès.');
    }

    // Suppression
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Événement supprimé avec succès.');
    }
}
