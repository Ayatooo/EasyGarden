<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForumReplyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'forum_post_id' => ['required', 'exists:forum_posts'],
            'user_id' => ['required', 'exists:users'],
            'content' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
