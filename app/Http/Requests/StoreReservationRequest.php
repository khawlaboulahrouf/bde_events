<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Seul un étudiant connecté peut réserver
        return $this->user() && $this->user()->role === 'student';
    }

    public function rules(): array
    {
        return [
            'event_id' => 'required|exists:events,id',
        ];
    }
}
