<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest;

class ReservationController extends Controller
{
    public function store(StoreReservationRequest $request)
    {
        $event = Event::findOrFail($request->event_id);
        $student = auth()->user();

        // Vérification 1 : l'étudiant a-t-il déjà réservé cet événement ?
        $dejaReserve = Reservation::where('student_id', $student->id)
            ->where('event_id', $event->id)
            ->exists();

        if ($dejaReserve) {
            return back()->with('error', 'Vous êtes déjà inscrit à cet événement.');
        }

        // Vérification 2 : reste-t-il des places ?
        if ($event->placesRestantes() <= 0) {
            return back()->with('error', 'Cet événement est complet.');
        }

        // Création de la réservation
        $reservation = Reservation::create([
            'student_id' => $student->id,
            'event_id' => $event->id,
            'reserved_at' => now(),
        ]);

        // Génération automatique du ticket associé
        $reservation->ticket()->create([
            'code_qr' => null, // à générer plus tard avec un package QR
        ]);

        return redirect()->route('reservations.mine')->with('success', 'Réservation confirmée !');
    }

    // Liste des réservations de l'étudiant connecté ("Mes Billets")
    public function mine()
    {
        $reservations = Reservation::where('student_id', auth()->id())
            ->with(['event', 'ticket'])
            ->get();

        return view('reservations.mine', compact('reservations'));
    }

    // Vue admin : voir les réservations d'un événement (US 1.2)
    public function forEvent(Event $event)
    {
        $reservations = $event->reservations()->with('student')->get();
        return view('reservations.for-event', compact('event', 'reservations'));
    }
}
