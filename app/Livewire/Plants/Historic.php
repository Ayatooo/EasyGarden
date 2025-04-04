<?php

namespace App\Livewire\Plants;

use App\Models\Plant;
use Livewire\Component;
use Illuminate\View\View;

class Historic extends Component
{
    public Plant $plant;
    public $tasks = [];

    public function mount(Plant $plant)
    {
        $this->plant = $plant;
        $this->loadTasks();
    }

    public function loadTasks()
    {
        $this->tasks = $this->plant->tasks()->orderBy('scheduled_at', 'desc')->get();
    }


    public function render(): View
    {
        return view('livewire.plants.historic', [
            'tasks' => $this->tasks
        ]);
    }
}
