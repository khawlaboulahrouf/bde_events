<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingApiController extends Controller
{
    public function __construct(
        private BookingService $bookingService
    ) {
    }

    public function tickets(Request $request)
    {
        $tickets = $this->bookingService->getStudentTickets(
            $request->user()
        );

        return response()->json([
            'tickets' => $tickets,
        ], 200);
    }

    public function book(Request $request, Event $event)
    {
        $result = $this->bookingService->book(
            $request->user(),
            $event
        );

        if (!$result['success']) {
            return response()->json([
                'message' => $result['message']
            ], 400);
        }

        return response()->json([
            'message' => 'Inscription réussie.',
            'reservation' => $result['reservation'],
            'ticket' => $result['ticket'],
        ], 201);
    }
}
