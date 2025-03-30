<?php

namespace App\Helpers;

use App\Models\ChatgptMessage;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Threads\ThreadResponse;

class OpenAIHelper
{

    /**
     * @return ThreadResponse
     */
    public static function createThread(): ThreadResponse
    {
        return OpenAI::threads()->create([]);
    }

    /**
     * @param string $prompt
     * @return ChatgptMessage
     */
    public static function createThreadMessage(string $prompt): ChatgptMessage
    {
        $threadId = auth()->user()->thread_id;
        $threadMessageResponse = OpenAI::threads()->messages()->create($threadId, [
            'role' => 'user',
            'content' => $prompt,
        ]);

        // On retourne le message object créé en DB
        return ChatgptMessage::create([
            'chatgpt_id' => $threadMessageResponse->id,
            'object' => $threadMessageResponse->object,
            'user_id' => auth()->user()->id ?? null,
            'run_id' => $threadMessageResponse->runId ?? null,
            'role' => $threadMessageResponse->role,
            'content' => $threadMessageResponse->content,
            'type' => $threadMessageResponse->type ?? $threadMessageResponse->role,
            'attachments' => $threadMessageResponse->attachments ?? null,
            'metadata' => $threadMessageResponse->metadata ?? null,
        ]);
    }
}
