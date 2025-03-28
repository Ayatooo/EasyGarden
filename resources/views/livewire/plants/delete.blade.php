<div>
    <flux:modal.trigger name="delete-plant-{{ $plant->id }}">
        <flux:icon name="trash" class="cursor-pointer text-red-600"/>
    </flux:modal.trigger>

    <flux:modal name="delete-plant-{{ $plant->id }}" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Supprimer cette plante?</flux:heading>

                <flux:text class="mt-2">
                    <p>Vous êtes sur le point de supprimer cette plante.</p>
                    <p>Cette action est irréversible.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer/>

                <flux:modal.close>
                    <flux:button variant="ghost">Annuler</flux:button>
                </flux:modal.close>

                <flux:button wire:click="deletePlant({{ $plant->id }})" variant="danger" class="cursor-pointer">
                    Supprimer
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
