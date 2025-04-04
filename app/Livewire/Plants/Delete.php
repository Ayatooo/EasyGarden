<?php

namespace App\Livewire\Plants;

use Illuminate\View\View;
use Livewire\Component;
use App\Models\Plant;

class Delete extends Component
{
    public Plant $plant;

    public function render(): View
    {
        return view('livewire.plants.delete');
    }

    public function deletePlant(): void
    {
        $this->plant->delete();
        $this->dispatch('plant-deleted'); // Événement pour rafraîchir la table
        $this->dispatch('close-modal', ['name' => "delete-plant-{$this->plant->id}"]); // Ferme la modal
    }
}
