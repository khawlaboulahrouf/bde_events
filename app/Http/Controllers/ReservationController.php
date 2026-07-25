<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest;
use Illuminate\Support\Facades\Redirect;

class ReservationController extends Controller
{
   public function store(StoreReservationRequest $request, Event $event)
   {
     $student = auth()->user();

     $exists = Reservation::where('student_id',$student->id)
       ->where('event_id',$event->id)
       ->exists();

    if($exists){
        return Redirect()->back()
        ->with('error','Vous aves deja reserve cet evenement');

    }
    if($event->placesRestantes() <=0){
        return Redirect()->back()
        ->with('error','Cet evenement est complet');
    }

    $reservation = Reservation::create([
        'student_id'=> $student->id,
        'event_id' => $event->id,
        'reserved_at'=> now(),
    ]);
   

    $reservation->ticket()->create([
        'ticket_code' => 'BDE-' .strtoupper(uniqid()),
    ]);
    return redirect()->route('resvations.mine')
    ->with('success' , 'Reservation effectuée avec succes');
   }

   public function mine()
   {
      $reservations = Reservation::where('students_id', auth()->id())
      ->with(['event' , 'ticket'])
      ->latest()
      ->get();

      return view('reservations.mine',compact('reservations'));
   }

   public function forEvent(Event $event)
   {
    $reservations = $event->reservations()
    ->with('student')
    ->latest()
    ->get();

    return view('admin.reservations.index',compact('event','reservations'));
   }
}
