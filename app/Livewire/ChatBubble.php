<?php

namespace App\Livewire;

use App\Helpers\OpenAIHelper;
use App\Models\ChatgptMessage;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Threads\Messages\ThreadMessageResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;

class ChatBubble extends Component
{
    public bool $isOpen = false;
    public bool $hasMessages;
    public string $prompt = '';
    public bool $waitingResponse = false;

    /**
     * @return View
     */
    public function render(): View
    {
        $this->hasMessages = auth()
            ->user()
            ->messages
            ->where('role', 'user')
            ->isNotEmpty();

        $messages = new Collection();
        if ($this->hasMessages) {
            $messages = $this->loadMessages();
            $messages = $messages->reverse();
        }
        return view('livewire.chat-bubble', [
            'messages' => $messages,
        ]);
    }

    /**
     * @return void
     */
    public function toggleChat(): void
    {
        $this->isOpen = !$this->isOpen;
    }

    /**
     * @return Collection
     */
    public function loadMessages(): Collection
    {
        return auth()
            ->user()
            ->messages()
            ->latest()
            ->take(5)
            ->get();
    }

    /**
     * @return void
     */
    public function sendMessage(): void
    {
        if ($this->prompt === '') {
            return;
        }

        OpenAIHelper::createThreadMessage($this->prompt);

        $this->prompt = '';

        $this->waitingResponse = true;
        $this->dispatch('messageSent');
    }

    /**
     * @throws Exception
     */
    #[On('messageSent')]
    public function runThread(): void
    {
        $threadId = auth()->user()->thread_id;
        $threadRunResponse = OpenAI::threads()->runs()->create(
            threadId: $threadId,
            parameters: ['assistant_id' => config('app.assistant_id')]
        );

        $this->waitForThreadRun($threadId, $threadRunResponse);

        $message = $this->getAssistantMessage($threadId);

        ChatgptMessage::create([
            'chatgpt_id' => $message->id,
            'object' => $message->object,
            'user_id' => auth()->user()->id ?? null,
            'run_id' => $message->runId ?? null,
            'role' => $message->role,
            'content' => $message->content,
            'type' => $message->type ?? $message->role,
            'attachments' => $message->attachments ?? null,
            'metadata' => $message->metadata ?? null,
        ]);

        $this->waitingResponse = false;
    }

    /**
     * @param string $threadId
     * @param $threadRunResponse
     * @return ThreadRunResponse
     */
    protected function waitForThreadRun(string $threadId, $threadRunResponse): ThreadRunResponse
    {
        while (in_array($threadRunResponse->status, ['queued', 'in_progress'])) {
            $threadRunResponse = OpenAI::threads()->runs()->retrieve(
                threadId: $threadId,
                runId: $threadRunResponse->id
            );
            sleep(1);
        }

        return $threadRunResponse;
    }

    /**
     * @param string $threadId
     * @return ThreadMessageResponse|Exception
     * @throws Exception
     */
    protected function getAssistantMessage(string $threadId): ThreadMessageResponse|Exception
    {
        $threadMessageListResponse = OpenAI::threads()->messages()->list($threadId)->data;
        return collect($threadMessageListResponse)->first(fn($message) => $message->role === 'assistant') ?? throw new Exception('Une erreur est survenue lors de la récupération, veuillez patienter et réessayer.');
    }
}
