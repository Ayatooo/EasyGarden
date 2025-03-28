<?php

namespace App\Livewire\Forum;

use App\Models\ForumPost;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ForumIndex extends Component
{
    use WithPagination;

    public ?string $selectedCategory = '';

    /**
     * @return View
     */
    public function render(): View
    {
        $posts = $this->loadPosts();

        return view('livewire.forum.forum-index', [
            'posts' => $posts,
        ]);
    }

    #[On('loadForumPosts')]
    public function loadPosts(): LengthAwarePaginator
    {
        return ForumPost::when($this->selectedCategory, function ($query) {
            return $query->where('category', $this->selectedCategory);
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
}
