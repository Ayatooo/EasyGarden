<?php

namespace App\Livewire\Forum;

use App\Models\ForumPost;
use App\Models\ForumReply;
use Illuminate\View\View;
use Livewire\Component;

class ForumShow extends Component
{
    public ForumPost $post;

    public function mount($postId): void
    {
        $this->post = ForumPost::findOrFail($postId);
    }

    public function render(): View
    {
        // Charger les réponses les plus récentes en premier
        $replies = ForumReply::where('forum_post_id', $this->post->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.forum.forum-show', [
            'replies' => $replies,
        ]);
    }
}
