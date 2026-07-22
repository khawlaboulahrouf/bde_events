<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 'titre', 'description', 'date', 'heure', 'lieu', 'prix', 'places',
    ];

    // Chaque événement appartient à l'admin qui l'a créé
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Un événement peut avoir plusieurs réservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Nombre de places restantes (suivi en temps réel)
    public function placesRestantes(): int
    {
        return $this->places - $this->reservations()->count();
    }
}
