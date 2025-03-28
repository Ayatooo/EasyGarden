<?php

namespace App\Livewire\Plants;

use Livewire\Component;
use App\Models\Plant;

class Delete extends Component
{
    public Plant $plant;

    public function render()
    {
        return view('livewire.plants.delete');
    }

    public function deletePlant()
    {
        $this->plant->delete();
        $this->dispatch('plant-deleted'); // Événement pour rafraîchir la table
        $this->dispatch('close-modal', ['name' => "delete-plant-{$this->plant->id}"]); // Ferme la modal
    }
}
