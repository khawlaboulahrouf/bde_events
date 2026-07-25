<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    public function index()
    {
        $events =Event::latest()->get();

        if(Auth::user()->role == 'admin')
            {
                return view('admin.events.index',compact('events'));
            }
        return view('events.index',compact('events'));
    }

    public function create()
    {
        return view ('admin.events.create');
    }

    public function store(StoreEventRequest $request)
    {
        Event::create([
            'admin_id' => Auth::id(),
            'titre'    => $request->titre,
            'description' => $request->description,
            'date'   => $request->date,
            'heure' => $request->heure,
            'lieu' => $request->lieu,
            'prix' => $request->prix,
            'places' => $request->places,
        ]);

        return redirect()
           ->route('admin.events.index')
           ->with('success' , 'Evenement ajouté avec succes');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(UpdateEventRequest $request , Event $event)
    {
        $event->update($request->validated());

        return redirect()
        ->route('admin.events.index')
        ->with('succes', 'Evenement modifié avec succes');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()
        ->route('admin.events.index')
        ->with('succes', 'Evenement supprimer avec succes');
    }
}
