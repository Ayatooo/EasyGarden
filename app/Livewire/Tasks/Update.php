<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use App\Models\Plant;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Livewire\Component;

class Update extends Component
{
    public Task $task;
    public string $task_type = '';
    public string $status = '';
    public ?string $scheduled_at = '';
    public ?string $description = '';
    public string $title = '';
    public string $submitText = '';
    public string $action = '';

    public function mount(Task $task): void
    {
        $this->task = $task;
        $this->task_type = $task->task_type;
        $this->status = $task->status;
        $this->scheduled_at = $task->scheduled_at
            ? Carbon::parse($task->scheduled_at)->format('Y-m-d')
            : null;

        $this->description = $task->description;

        $this->title = "Modifier la tâche";
        $this->submitText = "Modifier";
        $this->action = "updateTask({$task->id})";
    }

    public function render(): View
    {
        return view('livewire.tasks.update', [
            'plants' => Plant::where('user_id', auth()->id())->get(),
        ]);
    }

    public function updateTask(): void
    {
        $this->validate([
            'task_type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'scheduled_at' => 'nullable|date',
            'description' => 'nullable|string|max:1000',
        ]);

        $this->task->update([
            'task_type' => $this->task_type,
            'status' => $this->status,
            'scheduled_at' => $this->scheduled_at,
            'description' => $this->description,
        ]);

        $this->modal('update-task-' . $this->task->id)->close();
        $this->dispatch('task-updated')->to('tasks.all-tasks');
        $this->dispatch('task-updated')->to('tasks.today-tasks');
    }
}
