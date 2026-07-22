<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id', 'ticket_code', 'code_qr',
    ];

    // Le ticket appartient à une réservation
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    // Génère automatiquement un code unique du type BDE-2026-XXXXX à la création
    protected static function booted()
    {
        static::creating(function ($ticket) {
            $ticket->ticket_code = 'BDE-' . date('Y') . '-' . strtoupper(Str::random(5));
        });
    }
}
