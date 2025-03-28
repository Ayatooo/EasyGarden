@php use App\Models\Plant; @endphp
<div>
    <flux:modal.trigger name="create-plant">
        <flux:button class="w-fit cursor-pointer">Ajouter une plante</flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-plant" class="md:w-[800px] bg-white rounded-lg shadow-xl" wire:listener="close-modal">
        <div class="p-6">
            @include('livewire.plants._form', [
            'action' => 'createPlant',
            'title' => 'Nouvelle plante',
            'description' => 'Ajoutez une nouvelle plante à votre jardin.',
            'submitText' => 'Ajouter',
            ])
        </div>
    </flux:modal>
</div>
