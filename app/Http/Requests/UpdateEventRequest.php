<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after_or_equal:today',
            'heure' => 'required',
            'lieu' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'places' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre est obligatoire.',
            'description.required' => 'La description est obligatoire.',
            'date.required' => 'La date est obligatoire.',
            'date.after_or_equal' => 'La date doit être aujourd\'hui ou une date future.',
            'heure.required' => 'L\'heure est obligatoire.',
            'lieu.required' => 'Le lieu est obligatoire.',
            'prix.required' => 'Le prix est obligatoire.',
            'prix.min' => 'Le prix doit être supérieur ou égal à 0.',
            'places.required' => 'Le nombre de places est obligatoire.',
            'places.min' => 'Le nombre de places doit être supérieur à 0.',
        ];
    }
}
