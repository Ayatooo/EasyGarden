<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class TodayTask extends Component
{
    public Collection $tasksOfTheDay;

    public function mount(): void
    {
        $this->loadTask();
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.tasks.today-task');
    }

    #[On('task-deleted')]
    #[On('task-updated')]
    #[On('task-created')]
    public function loadTask(): void
    {
        $tasksOfTheDayToDo = Task::where('user_id', auth()->id())
            ->whereDate('scheduled_at', now()->toDateString())
            ->where('status', 'A venir')
            ->orderBy('task_type')
            ->get();

        $tasksOfTheDayDone = Task::where('user_id', auth()->id())
            ->whereDate('scheduled_at', now()->toDateString())
            ->where('status', 'Effectué')
            ->orderBy('task_type')
            ->get();

        $tasksOfTheDayCanceled = Task::where('user_id', auth()->id())
            ->whereDate('scheduled_at', now()->toDateString())
            ->where('status', 'Annulé')
            ->orderBy('task_type')
            ->get();

        $this->tasksOfTheDay = $tasksOfTheDayToDo->merge($tasksOfTheDayDone)->merge($tasksOfTheDayCanceled);
    }

    #[On('markAsDone')]
    public function markAsDone(int $taskId): void
    {
        $task = Task::find($taskId);
        $task->status = 'Effectué';
        $task->save();

        $this->dispatch('task-updated');
    }

    #[On('markAsCanceled')]
    public function markAsCanceled(int $taskId): void
    {
        $task = Task::find($taskId);
        $task->status = 'Annulé';
        $task->save();

        $this->dispatch('task-updated');
    }
}
