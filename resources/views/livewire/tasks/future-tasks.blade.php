<div>
    <div class="mb-4">
        <p class="text-sm text-gray-500 dark:text-white">Liste des tâches planifiées pour les prochains jours.</p>
    </div>

    @if(empty($tasksGroupedByDate))
        <p class="text-gray-500 dark:text-white">Aucune tâche future.</p>
    @else
        <div class="space-y-6">
            @foreach($tasksGroupedByDate as $date => $tasks)
                <div>
                    <h3 class="text-md font-semibold text-emerald-600">{{ \Carbon\Carbon::parse($date)->translatedFormat('l d F Y') }}</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-2">
                        @foreach($tasks as $task)
                            <div class="bg-white  dark:bg-zinc-700 shadow-sm rounded-lg p-4 flex flex-col space-y-3">
                                <!-- Image et Nom de la Plante -->
                                <div class="flex items-center space-x-4">
                                    <img src="{{ $task['plant']['image_url'] ?? null}}"
                                         alt="{{ ucfirst($task['plant']['name'][0]) }}"
                                         class="w-12 h-12 rounded-lg">
                                    <div>
                                        <p class="font-bold">{{ $task['plant']['name'] }}</p>
                                        <p class="text-sm text-gray-500 dark:text-white">{{ ucfirst($task['task_type']) }}</p>
                                    </div>
                                </div>

                                <!-- Statut sous forme de Badge -->
                                <div class="flex justify-between items-center">
                                    <span class="{{ $task['status'] === 'A venir' ? 'bg-yellow-100 text-yellow-800' : ($task['status'] === 'Effectué' ? 'bg-green-100 text-emerald-800' : 'bg-red-100 text-red-800') }} px-2 py-1 text-xs font-medium rounded">
                                        {{ $task['status'] }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
