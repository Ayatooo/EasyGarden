<?php

namespace App\Livewire\Tasks;

use App\Models\Plant;
use App\Models\Task;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class Create extends Component
{
    public ?string $task_type;
    public ?string $scheduled_at;
    public string $status = 'A venir';
    public ?string $description = null;
    public Collection $plants;
    public ?int $plant_id;

    public function mount(): void
    {
        $date = new DateTime();
        $this->scheduled_at = $date->format('Y-m-d');
        $this->plants = Plant::where('user_id', auth()->id())->get();
        $this->task_type = null;
        $this->plant_id = null;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.tasks.create');
    }

    /**
     * @return void
     */
    public function createTask(): void
    {
        $task = new Task();
        $this->validate([
            'plant_id' => 'required|exists:plants,id',
            'task_type' => 'required|in:' . implode(',', Task::TYPE_OPTIONS),
            'scheduled_at' => 'required|date',
            'status' => 'required|in:Annulé,A venir,Effectué',
            'description' => 'nullable|string|max:1000',
        ]);

        $task->plant_id = $this->plant_id;
        $task->user_id = auth()->id();
        $task->task_type = $this->task_type;
        $task->status = $this->status;
        $task->scheduled_at = $this->scheduled_at;
        $task->description = $this->description;
        $task->save();

        $this->modal('create-task')->close();
        $this->dispatch('task-created');

        $date = new DateTime();
        $this->scheduled_at = $date->format('Y-m-d');
        $this->reset([
            'plant_id',
            'task_type',
            'status',
            'description',
        ]);
    }
}
