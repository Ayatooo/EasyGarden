@php use App\Models\Task; @endphp
<div>
    <flux:modal.trigger name="create-task">
        <flux:button class="cursor-pointer">Ajouter une tâche</flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-task" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Ajouter une tâche</flux:heading>
                <flux:text class="mt-2">Remplissez le formulaire ci-dessous pour créer une nouvelle tâche 📜</flux:text>
            </div>

            <flux:select label="Plante" wire:model="plant_id" required>
                <option value="">Choisissez une plante</option>
                @foreach ($plants as $plant)
                    <option value="{{ $plant->id }}">{{ $plant->name }}</option>
                @endforeach
            </flux:select>

            <flux:select label="Type de tâche" wire:model="task_type" required>
                <option value="">Choisissez un type de tâche</option>
                @foreach (Task::TYPE_OPTIONS as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </flux:select>

            <flux:input type="date" label="A faire le" wire:model="scheduled_at"/>

            <flux:select label="Statut" wire:model="status">
                <option value="A venir">A venir</option>
                <option value="Effectué">Effectué</option>
                <option value="Annulé">Annulé</option>
            </flux:select>

            <div class="flex">
                <flux:spacer/>

                <flux:button type="submit" wire:click="createTask" variant="primary">Créer</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
