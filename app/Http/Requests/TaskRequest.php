<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'plant_id' => ['required', 'exists:plants'],
            'user_id' => ['required', 'exists:users'],
            'task_type' => ['required'],
            'scheduled_at' => ['required', 'date'],
            'status' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
