<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Illuminate\View\View;
use Livewire\Component;

class Delete extends Component
{
    public Task $task;

    public function render(): View
    {
        return view('livewire.tasks.delete');
    }

    public function deleteTask(): void
    {
        $this->task->delete();
        $this->dispatch('task-deleted');
        $this->dispatch('close-modal', ['name' => "delete-task-{$this->task->id}"]);
    }
}
