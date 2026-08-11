<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Ticket;

class BookingApiController extends Controller
{
    public function tickets(Request $request)
    {
        $tickets = Ticket::whereHas('reservation', function ($query) use ($request) {
            $query->where('student_id', $request->user()->id);
        })
            ->with('reservation.event')
            ->latest()
            ->get();

        return response()->json([
            'tickets' => $tickets,
        ], 200);
    }


    public function book(Request $request, Event $event)
    {
        $student = $request->user();

        // Vérifier si l'étudiant a déjà réservé
        $alreadyBooked = Reservation::where('student_id', $student->id)
            ->where('event_id', $event->id)
            ->exists();

        if ($alreadyBooked) {
            return response()->json([
                'message' => 'Vous avez déjà réservé cet événement.'
            ], 400);
        }

        // Vérifier la capacité
        $bookingsCount = $event->reservations()->count();

        if ($bookingsCount >= $event->places) {
            return response()->json([
                'message' => 'Les inscriptions pour cet événement sont complètes.'
            ], 400);
        }

        // Créer la réservation
        $reservation = Reservation::create([
            'student_id' => $request->user()->id,
            'event_id' => $event->id,
            'reserved_at' => now(),
        ]);

        $ticket = Ticket::create([
            'reservation_id' => $reservation->id,
            'ticket_code' => 'BDE-' . date('Y') . '-' . strtoupper(bin2hex(random_bytes(5))),
        ]);

        return response()->json([
            'message' => 'Inscription réussie.',
            'reservation' => $reservation,
            'ticket' => $ticket,
        ], 201);
    }
}
