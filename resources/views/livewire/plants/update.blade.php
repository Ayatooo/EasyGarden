<div>
    <flux:modal.trigger name="update-plant-{{ $plant->id }}">
        <flux:icon name="pencil" class="cursor-pointer text-emerald-600"/>
    </flux:modal.trigger>

    <flux:modal name="update-plant-{{ $plant->id }}" class="md:w-[800px] bg-white rounded-lg shadow-xl"
                wire:listener="close-modal">
        <div class="p-6">
            @include('livewire.plants._form', [
            'action' => "updatePlant({$plant->id})",
            'title' => 'Modifier la plante',
            'description' => 'Modifiez les informations de votre plante.',
            'submitText' => 'Modifier',
            ])
        </div>
    </flux:modal>
</div>
