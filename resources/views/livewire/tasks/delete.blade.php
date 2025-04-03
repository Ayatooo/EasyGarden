<div>
    <flux:modal.trigger name="delete-task-{{ $task->id }}">
        <flux:icon name="trash" class="cursor-pointer text-red-600"/>
    </flux:modal.trigger>

    <flux:modal name="delete-task-{{ $task->id }}" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Supprimer cette tâche?</flux:heading>

                <flux:text class="mt-2">
                    <p>Vous êtes sur le point de supprimer cette tâche.</p>
                    <p>Cette action est irréversible.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer/>

                <flux:modal.close>
                    <flux:button variant="ghost">Annuler</flux:button>
                </flux:modal.close>

                <flux:button wire:click="deleteTask({{ $task->id }})" variant="danger" class="cursor-pointer">
                    Supprimer
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
