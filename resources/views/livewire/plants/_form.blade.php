
@php use App\Models\Plant; @endphp

<form wire:submit="{{ $action }}" class="space-y-8">
    <div class="border-b pb-4">
        <flux:heading size="lg">{{ $title }}</flux:heading>
        <flux:text class="mt-2 text-gray-600">{{ $description }}</flux:text>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <div class="space-y-6">
            @if($image)
                <img src="{{ Storage::disk('s3')->temporaryUrl($image, now()->addMinutes(5)) }}" alt="{{ ucfirst($name[0]) }}" class="w-20 h-20 object-cover rounded-full">
            @endif
            <flux:input type="file" wire:model="image" label="Image de la plante" class="text-sm"/>
            <flux:input wire:model="name" label="Nom de la plante" placeholder="Par exemple : Ficus elastica"
                        class="text-sm"/>
            <flux:input wire:model="watering_frequency" type="number" label="Fréquence d'arrosage (jours)"
                        placeholder="Par exemple : 2" class="text-sm"/>
        </div>

        <div class="space-y-6">
            <flux:select wire:model="type" label="Type de plante" placeholder="Sélectionnez un type" class="text-sm">
                @foreach (Plant::TYPE_OPTIONS as $type)
                    <flux:select.option value="{{ $type }}">{{ $type }}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:select wire:model="soil_type" label="Type de sol" placeholder="Sélectionnez un type de sol"
                         class="text-sm">
                @foreach (Plant::SOIL_TYPE_OPTIONS as $type)
                    <flux:select.option value="{{ $type }}">{{ $type }}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:select wire:model="sun_exposure" label="Exposition au soleil"
                         placeholder="Sélectionnez une exposition" class="text-sm">
                @foreach (Plant::SUN_EXPOSURE_OPTIONS as $exposure)
                    <flux:select.option value="{{ $exposure }}">{{ $exposure }}</flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <div>
        <flux:textarea wire:model="notes" label="Notes" placeholder="Notes sur la plante" class="text-sm"/>
    </div>

    <div class="flex pt-4 border-t">
        <flux:spacer/>
        <flux:button type="submit" variant="primary" class="cursor-pointer">
            {{ $submitText }}
        </flux:button>
    </div>
</form>
