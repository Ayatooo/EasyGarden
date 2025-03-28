<?php

namespace App\Livewire\Forum;

use App\Models\ForumReply;
use Illuminate\View\View;
use Livewire\Component;

class CreateReply extends Component
{
    public int $forumPostId;
    public string $content;

    public function mount(int $forumPostId): void
    {
        $this->forumPostId = $forumPostId;
        $this->content = '';
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.forum.create-reply');
    }

    /**
     * @return void
     */
    public function createForumReply(): void
    {
        $this->validate([
            'content' => 'required',
        ]);

        ForumReply::create([
            'forum_post_id' => $this->forumPostId,
            'user_id' => auth()->id(),
            'content' => $this->content,
        ]);

        self::modal('create-forum-reply')->close();

        $this->dispatch('loadForumShow');
        $this->reset([
            'content',
        ]);
    }
}
