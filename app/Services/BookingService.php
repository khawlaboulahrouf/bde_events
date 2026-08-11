<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Reservation;
use App\Models\Ticket;
use App\Models\User;

class BookingService
{
    public function getStudentTickets(User $student)
    {
        return Ticket::whereHas('reservation', function ($query) use ($student) {
            $query->where('student_id', $student->id);
        })
            ->with('reservation.event')
            ->latest()
            ->get();
    }

    public function book(User $student, Event $event)
    {
        // Vérifier si l'étudiant a déjà réservé
        $alreadyBooked = Reservation::where('student_id', $student->id)
            ->where('event_id', $event->id)
            ->exists();

        if ($alreadyBooked) {
            return [
                'success' => false,
                'message' => 'Vous avez déjà réservé cet événement.'
            ];
        }

        // Vérifier la capacité
        $bookingsCount = $event->reservations()->count();

        if ($bookingsCount >= $event->places) {
            return [
                'success' => false,
                'message' => 'Les inscriptions pour cet événement sont complètes.'
            ];
        }

        // Créer la réservation
        $reservation = Reservation::create([
            'student_id' => $student->id,
            'event_id' => $event->id,
            'reserved_at' => now(),
        ]);

        // Créer le ticket
        $ticket = Ticket::create([
            'reservation_id' => $reservation->id,
            'ticket_code' => 'BDE-' . date('Y') . '-' . strtoupper(bin2hex(random_bytes(5))),
        ]);

        return [
            'success' => true,
            'reservation' => $reservation,
            'ticket' => $ticket,
        ];
    }
}
