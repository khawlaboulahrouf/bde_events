<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;

class BookingApiController extends Controller
{
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
            'student_id' => $student->id,
            'event_id' => $event->id,
            'reserved_at' => now(),
        ]);

        return response()->json([
            'message' => 'Inscription réussie.',
            'reservation' => $reservation,
        ], 201);
    }
}
