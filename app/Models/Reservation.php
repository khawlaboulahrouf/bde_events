<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'event_id', 'reserved_at',
    ];

    // La réservation appartient à un étudiant
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // La réservation concerne un événement
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Une réservation génère un seul ticket
    public function ticket()
    {
        return $this->hasOne(Ticket::class);
    }
}
