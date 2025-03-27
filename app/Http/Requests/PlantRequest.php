<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlantRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users'],
            'name' => ['required'],
            'image' => ['nullable'],
            'type' => ['required'],
            'watering_frequency' => ['required'],
            'sun_exposure' => ['required'],
            'soil_type' => ['required'],
            'notes' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
