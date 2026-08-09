<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 'lastname', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Un admin peut créer plusieurs événements (relation "+create" du diagramme)
    public function events()
    {
        return $this->hasMany(Event::class, 'admin_id');
    }

    // Un étudiant peut avoir plusieurs réservations (relation "+reserved")
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'student_id');
    }

    // Helper pratique pour vérifier le rôle (utilisé dans le middleware plus tard)
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
