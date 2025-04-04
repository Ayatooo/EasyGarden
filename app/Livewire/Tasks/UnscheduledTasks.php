<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class UnscheduledTasks extends Component
{
    public Collection $tasks;

    #[On('task-updated')]
    #[On('task-deleted')]
    #[On('task-created')]
    public function loadTasks(): void
    {
        $this->tasks = Task::with('plant')
            ->where('user_id', auth()->id())
            ->whereNull('scheduled_at')
            ->latest()
            ->get();
    }

    public function mount(): void
    {
        $this->loadTasks();
    }


    public function render(): View
    {
        return view('livewire.tasks.unscheduled-tasks');
    }
}
