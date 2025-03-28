<?php

namespace App\Livewire\Forum;

use App\Models\ForumPost;
use App\Models\ForumReply;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
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
        $replies = $this->loadForumReplies();

        return view('livewire.forum.forum-show', [
            'replies' => $replies,
        ]);
    }

    #[On('loadForumShow')]
    public function loadForumReplies(): Collection
    {
        return ForumReply::where('forum_post_id', $this->post->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
