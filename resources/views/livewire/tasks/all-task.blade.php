<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-3">
    @foreach($tasksOfTheDay as $task)
        <div class="bg-white shadow-sm rounded-lg p-4 flex flex-col space-y-3">
            <!-- Image et Nom de la Plante -->
            <div class="flex items-center space-x-4">
                <img src="{{ $task->plant->image_url }}" alt="{{ ucfirst($task->plant->name[0]) }}" class="w-10 h-10 object-cover rounded-full">
                <div>
                    <p class="font-bold">{{ $task->plant->name }}</p>
                    <p class="text-sm text-gray-500">{{ ucfirst($task->task_type) }}</p>
                </div>
            </div>

            <!-- Statut sous forme de Badge -->
            <div class="flex items-center justify-between">
                <!-- Badge du statut -->
                <flux:badge
                    color="{{ $task->status === 'A venir' ? 'yellow' : ($task->status === 'Effectué' ? 'green' : 'red') }}">
                    {{ $task->status }}
                </flux:badge>

                @if($task->status === 'A venir')
                    <div class="flex space-x-2">
                        <flux:button size="xs" wire:click="markAsDone({{ $task->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-green-700 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </flux:button>

                        <flux:button size="xs" wire:click="markAsCanceled({{ $task->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-red-700 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </flux:button>
                    </div>
                @endif
            </div>

        </div>
    @endforeach
</div>
