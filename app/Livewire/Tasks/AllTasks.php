<?php

namespace App\Livewire\Tasks;

use App\Models\Plant;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\On;
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

    /**
     * @return View
     */
    public function render(): View
    {
        $tasks = $this->loadTasks();
        $tasks->each(function ($task) {
            $task->bgColor = match ($task->status) {
                'A venir' => 'bg-blue-200 text-blue-800 dark:bg-blue-600 dark:text-white',
                'Effectué' => 'bg-emerald-200 text-emerald-800 dark:bg-emerald-600 dark:text-white',
                default => 'bg-red-200 text-red-800 dark:bg-red-800 dark:text-white',
            };
        });

        return view('livewire.tasks.all-tasks', [
            'tasks' => $tasks,
            'plants' => Plant::where('user_id', auth()->id())->get(),
        ]);
    }

    #[On('task-deleted')]
    #[On('task-updated')]
    #[On('task-created')]
    public function loadTasks(): LengthAwarePaginator
    {
        return Task::with('plant')
            ->where('user_id', auth()->id())
            ->when($this->search, fn(Builder $q) => $q->where(function ($query) {
                $query->where('task_type', 'like', "%$this->search%")
                    ->orWhere('status', 'like', "%$this->search%")
                    ->orWhere('description', 'like', "%$this->search%")
                    ->orWhereHas('plant', fn($q) => $q->where('name', 'like', "%$this->search%"));
            }))
            ->when($this->filterType, fn($q) => $q->where('task_type', $this->filterType))
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->when($this->filterPlant, fn($q) => $q->where('plant_id', $this->filterPlant))
            ->orderBy('scheduled_at')
            ->paginate(10);
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

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilterType(): void
    {
        $this->resetPage();
    }

    public function updatingFilterStatus(): void
    {
        $this->resetPage();
    }

    public function updatingFilterPlant(): void
    {
        $this->resetPage();
    }
}
