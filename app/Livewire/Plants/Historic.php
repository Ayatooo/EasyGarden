<?php

namespace App\Livewire\Plants;

use App\Models\Plant;
use App\Models\Task;
use Illuminate\View\View;
use Livewire\Component;

class Historic extends Component
{
    protected $queryString = ['filterType'];

    public Plant $plant;
    public $tasks;

    public string $filterType = '';

    public function mount(Plant $plant): void
    {
        $this->plant = $plant;
        $this->loadTasks();
    }

    public function updatedFilterType(): void
    {
        $this->loadTasks();
    }

    public function resetFilters(): void
    {
        $this->filterType = '';
        $this->loadTasks();
    }

    public function loadTasks(): void
    {
        $this->tasks = $this->plant->tasks()
            ->when($this->filterType, fn($query) =>
            $query->where('task_type', $this->filterType)
            )
            ->whereNotNull('scheduled_at')
            ->orderBy('scheduled_at', 'desc')
            ->get();
    }

    public function render(): View
    {
        return view('livewire.plants.historic', [
            'tasks' => $this->tasks,
            'taskTypes' => Task::TYPE_OPTIONS,
        ]);
    }
}
