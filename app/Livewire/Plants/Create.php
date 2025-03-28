<?php
namespace App\Livewire\Plants;
use DateTime;
use App\Models\Plant;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public string $title = '';
    public string $description = '';
    public string $submitText = '';
    public string $action = '';
    public string $name = '';
    public string $image = '';
    public string $type = '';
    public int $watering_frequency = 0;
    public string $sun_exposure = '';
    public string $soil_type = '';
    public string $notes = '';
    public string $scheduled_at;

    public function mount(): void
    {
        $date = new DateTime();
        $this->scheduled_at = $date->format('Y-m-d');
        $this->title = "Nouvelle plante";
        $this->description = "Ajoutez une nouvelle plante à votre jardin.";
        $this->submitText = "Ajouter";
        $this->action = "createPlant";
    }

    public function render()
    {
        return view('livewire.plants.create');
    }

    public function createPlant()
    {
        $plant = new Plant();
        $this->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:' . implode(',', Plant::TYPE_OPTIONS),
            'watering_frequency' => 'required|numeric',
            'sun_exposure' => 'required|string|in:' . implode(',', Plant::SUN_EXPOSURE_OPTIONS),
            'soil_type' => 'required|string|in:' . implode(',', Plant::SOIL_TYPE_OPTIONS),
            'notes' => 'nullable|string|max:255',
        ]);

        $plant->user_id = auth()->user()->id;
        $plant->name = $this->name;
        $plant->image = $this->image;
        $plant->type = $this->type;
        $plant->watering_frequency = $this->watering_frequency;
        $plant->sun_exposure = $this->sun_exposure;
        $plant->soil_type = $this->soil_type;
        $plant->notes = $this->notes;
        $plant->save();

        $this->dispatch('plant-created');
    }
}

