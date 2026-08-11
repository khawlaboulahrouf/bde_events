<?php

namespace App\Services;

use App\Models\Event;
use App\Models\User;

class EventService
{
    public function getAllEvents()
    {
        return Event::with('admin')
            ->withCount('reservations')
            ->latest()
            ->get();
    }

    public function getEvent(Event $event)
    {
        $event->load('admin');
        $event->loadCount('reservations');

        return $event;
    }

    public function createEvent(User $admin, array $data)
    {
        return Event::create([
            'admin_id' => $admin->id,
            'titre' => $data['titre'],
            'description' => $data['description'],
            'date' => $data['date'],
            'heure' => $data['heure'],
            'lieu' => $data['lieu'],
            'prix' => $data['prix'],
            'places' => $data['places'],
        ]);
    }

    public function updateEvent(Event $event, array $data)
    {
        $event->update($data);

        return $event->fresh();
    }

    public function deleteEvent(Event $event)
    {
        return $event->delete();
    }
}
