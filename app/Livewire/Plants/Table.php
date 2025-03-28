<?php

namespace App\Livewire\Plants;

use App\Models\Plant;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class Table extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.plants.table', [
            'plants' => Plant::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->paginate(10)
        ]);
    }

    #[On('plant-updated')]
    #[On('plant-deleted')]
    #[On('plant-created')]
    public function refreshPlants()
    {
        $this->resetPage();
    }

    public function AllPlants()
    {
        $plants = Plant::all();
        return $plants;
    }
}
