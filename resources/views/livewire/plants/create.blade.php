@php use App\Models\Plant; @endphp
<div>
    <flux:modal.trigger name="create-plant">
        <flux:button class="w-fit cursor-pointer">Ajouter une plante</flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-plant" class="md:w-96">
        <form wire:submit="createPlant" class="space-y-6">
            <div>
                <flux:heading size="lg">Nouvelle plante</flux:heading>
                <flux:text class="mt-2">Ajoutez une nouvelle plante à votre jardin.</flux:text>
            </div>

            <flux:input type="file" wire:model="image" label="Image de la plante" />
            <flux:input wire:model="name" label="Nom de la plante" placeholder="Par exemple : Ficus elastica" />

            <flux:select wire:model="type" label="Type de plante" placeholder="Sélectionnez un type">
                @foreach (Plant::TYPE_OPTIONS as $type)
                <flux:select.option value="{{ $type }}">{{ $type }}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:input wire:model="watering_frequency" type="number" label="Fréquence d'arrosage (jours)" placeholder="Par exemple : 2" />

            <flux:select wire:model="soil_type" label="Type de sol" placeholder="Sélectionnez un type de sol">
                @foreach (Plant::SOIL_TYPE_OPTIONS as $type)
                <flux:select.option value="{{ $type }}">{{ $type }}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:select wire:model="sun_exposure" label="Exposition au soleil" placeholder="Sélectionnez une exposition">
                @foreach (Plant::SUN_EXPOSURE_OPTIONS as $exposure)
                <flux:select.option value="{{ $exposure }}">{{ $exposure }}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:textarea wire:model="notes" label="Notes" placeholder="Notes sur la plante" />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">Ajouter</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
