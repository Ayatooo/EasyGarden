<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class FutureTasks extends Component
{
    public array $tasksGroupedByDate = [];

    public function mount(): void
    {
        $this->loadFutureTasks();
    }

    public function render(): View
    {
        return view('livewire.tasks.future-tasks');
    }

    #[On('loadFutureTasks')]
    public function loadFutureTasks(): void
    {
        $tasks = Task::where('user_id', auth()->id())
            ->with('plant')
            ->where('scheduled_at', '>', now())
            ->orderBy('scheduled_at')
            ->orderBy('task_type')
            ->get();

        $this->tasksGroupedByDate = $tasks->groupBy(fn($task) => Carbon::parse($task->scheduled_at)->format('Y-m-d'))->toArray();
    }

}
