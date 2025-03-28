<?php

namespace App\Livewire\Forum;

use App\Models\ForumPost;
use Illuminate\View\View;
use Livewire\Component;

class Create extends Component
{
    public string $category;
    public string $title;
    public string $content;

    public function mount(): void
    {
        $this->category = '';
        $this->title = '';
        $this->content = '';
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.forum.create');
    }

    /**
     * @return void
     */
    public function createForumPost(): void
    {
        $this->validate([
            'category' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);

        ForumPost::create([
            'user_id' => auth()->id(),
            'category' => $this->category,
            'title' => $this->title,
            'content' => $this->content,
        ]);

        self::modal('create-forum-post')->close();

        $this->dispatch('loadForumPosts');
        $this->reset([
            'category',
            'title',
            'content',
        ]);
    }
}
