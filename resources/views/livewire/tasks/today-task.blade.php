<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-3">
    @forelse($tasksOfTheDay as $task)
        <div class="bg-white dark:bg-zinc-700 shadow-sm rounded-lg p-4 flex flex-col space-y-3">
            <!-- Image et Nom de la Plante -->
            <div class="flex items-center space-x-4">
                <img src="{{ $task->plant->image_url }}" alt="{{ ucfirst($task->plant->name[0]) }}"
                     class="w-10 h-10 object-cover rounded-full">
                <div>
                    <p class="font-bold dark:text-white">{{ $task->plant->name }}</p>
                    <p class="text-sm text-gray-500 dark:text-white">{{ ucfirst($task->task_type) }}</p>
                </div>
            </div>

            <!-- Description de la tâche -->
            <p class="text-sm text-gray-500 dark:text-white">
                {{ $task->description }}
            </p>

            <!-- Statut sous forme de Badge -->
            <div class="flex items-center justify-between">

                <!-- Badge du statut -->
                <span
                    class="{{ $task->status === 'A venir' ? 'bg-yellow-100 text-yellow-800' : ($task->status === 'Effectué' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }} px-2 py-1 text-xs font-medium rounded">
                    {{ $task->status }}
                </span>

                @if($task->status === 'A venir')
                    <div class="flex space-x-2">
                        <flux:tooltip content="Marquer comme effectué">
                            <flux:button size="xs" wire:click="markAsDone({{ $task->id }})" class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-green-700 h-4 w-4" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7"/>
                                </svg>
                            </flux:button>
                        </flux:tooltip>

                        <flux:tooltip content="Marquer comme annulé">
                            <flux:button size="xs" wire:click="markAsCanceled({{ $task->id }})" class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-red-700 h-4 w-4" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </flux:button>
                        </flux:tooltip>
                    </div>
                @endif
            </div>

        </div>
    @empty
        <div class="bg-indigo-50 border-indigo-300 text-indigo-600 px-4 py-3 mt-5" role="alert">
            <p class="font-bold">Repos bien mérité 🌴</p>
            <p class="text-sm">
                Vous n'avez aucune tâche à effectuer pour le moment. Profitez-en pour vous reposer !
            </p>
        </div>
    @endforelse
</div>
