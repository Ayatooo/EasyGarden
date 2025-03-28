<?php

namespace App\Livewire\Plants;

use App\Models\Plant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class Table extends Component
{
    use WithPagination;

    public function render(): View
    {
        return view('livewire.plants.table', [
            'plants' => $this->loadPlants(),
        ]);
    }

    #[On('plant-updated')]
    #[On('plant-deleted')]
    #[On('plant-created')]
    public function refreshPlants(): void
    {
        $this->resetPage();
    }

    /**
     * @return LengthAwarePaginator
     */
    public function loadPlants(): LengthAwarePaginator
    {
        return Plant::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
}
