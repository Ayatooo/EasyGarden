@php use App\Models\Task; @endphp
<div>
    <flux:modal.trigger name="plan-task-{{ $task->id }}">
        <flux:icon name="calendar" class="w-5 h-5 text-green-500 dark:text-green-500" />
    </flux:modal.trigger>

    <flux:modal name="plan-task-{{ $task->id }}" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Planifier une tâche</flux:heading>
                <flux:text class="mt-2">Choisissez la date de la tâche 📅</flux:text>
            </div>

            <div class="flex items-end space-x-2">
                <flux:input type="date" label="À faire le" wire:model.live="newDate" class="flex-1" />

                @if ($newDate)
                    <flux:button wire:click="$set('newDate', null)">
                        ❌
                    </flux:button>
                @endif
            </div>

            <div class="flex">
                <flux:spacer/>

                <flux:button type="submit" wire:click="saveDate" variant="primary">Planifier</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
