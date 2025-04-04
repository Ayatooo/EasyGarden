<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Illuminate\View\View;
use Livewire\Component;

class Plan extends Component
{
    public Task $task;
    public ?string $newDate = null;
    public ?string $scheduled_at = null;

    public function mount(Task $task): void
    {
        $this->newDate = $task->scheduled_at;
        $this->scheduled_at = $task->scheduled_at;
    }

    public function render(): View
    {
        return view('livewire.tasks.plan');
    }

    public function saveDate(): void
    {

        $this->validate([
            'newDate' => 'required|date',
        ]);

        $this->task->update([
            'scheduled_at' => $this->newDate,
        ]);

        $this->modal('task-plan-' . $this->task->id)->close();

        $this->dispatch('task-updated')->to('tasks.unscheduled-tasks');
        $this->dispatch('task-updated')->to('tasks.all-tasks');
        $this->dispatch('task-updated')->to('tasks.today-tasks');
    }
}
