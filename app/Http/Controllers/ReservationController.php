<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest;

class ReservationController extends Controller
{
    // Réserver un événement
    public function store(StoreReservationRequest $request, Event $event)
    {
        $student = auth()->user();

        // Vérifier si l'étudiant a déjà réservé
        $exists = Reservation::where('student_id', $student->id)
            ->where('event_id', $event->id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'Vous avez déjà réservé cet événement.');
        }

        // Vérifier les places restantes
        if ($event->placesRestantes() <= 0) {
            return redirect()->back()
                ->with('error', 'Cet événement est complet.');
        }

        // Créer la réservation
        $reservation = Reservation::create([
            'student_id' => $student->id,
            'event_id' => $event->id,
            'reserved_at' => now(),
        ]);

        // Générer automatiquement le ticket
        $reservation->ticket()->create([
            'ticket_code' => 'BDE-' . strtoupper(uniqid()),
        ]);

        return redirect()->route('reservations.mine')
            ->with('success', 'Réservation effectuée avec succès.');
    }

    // Mes billets
    public function mine()
    {
        $reservations = Reservation::where('student_id', auth()->id())
            ->with(['event', 'ticket'])
            ->latest()
            ->get();

        return view('reservations.mine', compact('reservations'));
    }

    // Réservations d'un événement (Admin)
    public function forEvent(Event $event)
    {
        $reservations = $event->reservations()
            ->with('student')
            ->latest()
            ->get();

        return view('admin.reservations.index', compact('event', 'reservations'));
    }
}
