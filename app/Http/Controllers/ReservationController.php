<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    // Réserver un événement
    public function store(Event $event)
    {
        // Vérifier si l'événement est complet
        if ($event->placesRestantes() <= 0) {
            return back()->with('error', 'Cet événement est complet.');
        }

        // Vérifier si l'étudiant est déjà inscrit
        $exists = Reservation::where('student_id', Auth::id())
            ->where('event_id', $event->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Vous êtes déjà inscrit à cet événement.');
        }

        // Créer la réservation
        $reservation = Reservation::create([
            'student_id' => Auth::id(),
            'event_id' => $event->id,
        ]);

        // Générer le ticket
        Ticket::create([
            'reservation_id' => $reservation->id,
            'ticket_code' => 'BDE-' . date('Y') . '-' . strtoupper(Str::random(5)),
        ]);

        return redirect()->route('reservations.mine')
            ->with('success', 'Réservation effectuée avec succès.');
    }

    // Mes billets
    public function mine()
    {
        $reservations = Reservation::where('student_id', Auth::id())
            ->with(['event', 'ticket'])
            ->get();

        return view('reservations.mine', compact('reservations'));
    }

    // Liste des réservations d'un événement (Admin)
    public function forEvent(Event $event)
    {
        $reservations = $event->reservations()->with('student')->get();

        return view('admin.reservations.index', compact('event', 'reservations'));
    }
}
