<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-3">
    @forelse($tasks as $index => $task)
        <div class="bg-white dark:bg-zinc-700 shadow-sm rounded-lg p-4 flex flex-col space-y-3">
            <!-- Image + Nom Plante -->
            <div class="flex items-center space-x-4">
                <img src="{{ $task->plant->image_url }}" alt="{{ ucfirst($task->plant->name[0]) }}"
                     class="w-10 h-10 object-cover rounded-full">
                <div>
                    <p class="font-bold dark:text-white">{{ $task->plant->name }}</p>
                    <p class="text-sm text-gray-500 dark:text-white">{{ ucfirst($task->task_type) }}</p>
                </div>
            </div>

            <!-- Description -->
            <p class="text-sm text-gray-500 dark:text-white">{{ $task->description }}</p>

            <!-- Footer: Status + Actions -->
            <div class="flex items-center justify-between">
                <div class="flex space-x-2">
                    <flux:tooltip content="Planifier une date">
                        @livewire('tasks.plan', ['task' => $task], key("plan-{$task->id}-{$index}"))
                    </flux:tooltip>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-indigo-50 border-indigo-300 text-indigo-600 px-4 py-3 rounded" role="alert">
            <p class="font-bold">Aucune tâche à planifier 💤</p>
            <p class="text-sm">Toutes vos tâches sont déjà programmées.</p>
        </div>
    @endforelse
</div>
