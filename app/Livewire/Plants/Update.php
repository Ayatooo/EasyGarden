<?php

namespace App\Livewire\Plants;

use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Component;
use App\Models\Plant;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public Plant $plant;
    public $name = '';
    public $type = '';
    public $watering_frequency = '';
    public $sun_exposure = '';
    public $soil_type = '';
    public $notes = '';
    public $image = '';
    public string $title = '';
    public string $description = '';
    public string $submitText = '';
    public string $action = '';

    public function mount(Plant $plant): void
    {

        $this->plant = $plant;
        $this->name = $plant->name;
        $this->type = $plant->type;
        $this->watering_frequency = $plant->watering_frequency;
        $this->sun_exposure = $plant->sun_exposure;
        $this->soil_type = $plant->soil_type;
        $this->notes = $plant->notes;
        $this->image = $plant->image;

        $this->title = "Modifier la plante";
        $this->description = "Modifiez les informations de votre plante.";
        $this->submitText = "Modifier";
        $this->action = "updatePlant({$plant->id})";
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.plants.update');
    }

    /**
     * @return void
     */
    public function updatePlant(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:' . implode(',', Plant::TYPE_OPTIONS),
            'watering_frequency' => 'required|numeric',
            'sun_exposure' => 'required|string|in:' . implode(',', Plant::SUN_EXPOSURE_OPTIONS),
            'soil_type' => 'required|string|in:' . implode(',', Plant::SOIL_TYPE_OPTIONS),
            'notes' => 'nullable|string|max:255',
        ]);

        $image = Storage::disk('s3')->put('plants', $this->image);
        $this->plant->update([
            'name' => $this->name,
            'type' => $this->type,
            'watering_frequency' => $this->watering_frequency,
            'sun_exposure' => $this->sun_exposure,
            'soil_type' => $this->soil_type,
            'notes' => $this->notes,
            'image' => $image,
        ]);

        self::modal('update-plant-' . $this->plant->id)->close();
        $this->dispatch('plant-updated');
    }
}
