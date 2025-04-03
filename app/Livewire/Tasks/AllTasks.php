<?php

namespace App\Livewire\Tasks;

use App\Models\Plant;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class AllTasks extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterType = '';
    public string $filterStatus = '';
    public string $filterPlant = '';
    public int|null $editTaskId = null;

    protected $queryString = ['search', 'filterType', 'filterStatus', 'filterPlant'];


    public function render()
    {
        $tasks = Task::with('plant')
            ->where('user_id', auth()->id())
            ->when($this->search, fn(Builder $q) => $q->where(function ($query) {
                $query->where('task_type', 'ilike', "%{$this->search}%")
                    ->orWhere('status', 'ilike', "%{$this->search}%")
                    ->orWhere('description', 'ilike', "%{$this->search}%")
                    ->orWhereHas('plant', fn($q) => $q->where('name', 'ilike', "%{$this->search}%"));
            }))
            ->when($this->filterType, fn($q) => $q->where('task_type', $this->filterType))
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->when($this->filterPlant, fn($q) => $q->where('plant_id', $this->filterPlant))
            ->orderBy('scheduled_at', 'asc')
            ->paginate(10);

        return view('livewire.tasks.all-tasks', [
            'tasks' => $tasks,
            'plants' => Plant::where('user_id', auth()->id())->get(),
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function updatingFilterPlant()
    {
        $this->resetPage();
    }

    public function edit(int $taskId): void
    {
        $this->editTaskId = $taskId;
    }

    public function cancelEdit(): void
    {
        $this->editTaskId = null;
    }

    public function deleteConfirm(int $taskId): void
    {
        $this->dispatch('confirm-delete-task', id: $taskId);
    }

    public function delete(int $taskId): void
    {
        Task::findOrFail($taskId)->delete();
        $this->dispatch('task-deleted');
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->filterType = '';
        $this->filterStatus = '';
        $this->filterPlant = '';
        $this->resetPage();
    }
}
