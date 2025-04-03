@php use App\Models\Task; @endphp
<div>
    <flux:modal.trigger name="update-task-{{ $task->id }}">
        <flux:icon name="pencil" class="cursor-pointer text-emerald-600"/>
    </flux:modal.trigger>

    <flux:modal name="update-task-{{ $task->id }}" class="md:w-[600px] bg-white rounded-lg shadow-xl"
                wire:listener="close-modal">
        <div class="p-6">
            <form wire:submit.prevent="{{ $action }}" class="space-y-6">
                <div class="border-b pb-4">
                    <flux:heading size="lg">{{ $title }}</flux:heading>
                </div>

                <flux:select label="Type de tâche" wire:model="task_type" required>
                    <option value="">Choisissez un type de tâche</option>
                    @foreach (Task::TYPE_OPTIONS as $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </flux:select>

                <flux:select wire:model="status" label="Statut" placeholder="Choisissez un statut" class="text-sm">
                    <flux:select.option value="A venir">À venir</flux:select.option>
                    <flux:select.option value="Effectué">Effectué</flux:select.option>
                    <flux:select.option value="Annulé">Annulé</flux:select.option>
                </flux:select>

                <div class="flex items-end space-x-2">
                    <flux:input type="date" label="Date prévue" wire:model="scheduled_at" class="flex-1" />

                    @if ($scheduled_at)
                        <flux:button wire:click="$set('scheduled_at', null)">
                            ❌
                        </flux:button>
                    @endif
                </div>

                <flux:textarea wire:model="description" label="Description" placeholder="Détails de la tâche" class="text-sm"/>

                <div class="flex pt-4 border-t">
                    <flux:spacer/>
                    <flux:button type="submit" variant="primary" class="cursor-pointer">
                        {{ $submitText }}
                    </flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
</div>
