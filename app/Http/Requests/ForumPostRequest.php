<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForumPostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users'],
            'category' => ['required'],
            'title' => ['required'],
            'content' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
