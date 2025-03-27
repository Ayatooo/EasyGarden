<div>
    <div class="mb-4">
        <p class="text-sm text-gray-500">Liste des tâches planifiées pour les prochains jours.</p>
    </div>

    @if(empty($tasksGroupedByDate))
        <p class="text-gray-500">Aucune tâche future.</p>
    @else
        <div class="space-y-6">
            @foreach($tasksGroupedByDate as $date => $tasks)
                <div>
                    <h3 class="text-md font-semibold text-green-600">{{ \Carbon\Carbon::parse($date)->translatedFormat('l d F Y') }}</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-2">
                        @foreach($tasks as $task)
                            <div class="bg-white shadow-sm rounded-lg p-4 flex flex-col space-y-3">
                                <!-- Image et Nom de la Plante -->
                                <div class="flex items-center space-x-4">
                                    <img src="{{ $task['plant']['image'] ?? 'https://images.unsplash.com/photo-1480250555643-539ea5d6d746?q=80&w=1931&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGV8fDB8fHx8fA%3D%3D' }}"
                                         alt="{{ $task['plant']['name'] }}"
                                         class="w-12 h-12 rounded-lg">
                                    <div>
                                        <p class="font-bold">{{ $task['plant']['name'] }}</p>
                                        <p class="text-sm text-gray-500">{{ ucfirst($task['task_type']) }}</p>
                                    </div>
                                </div>

                                <!-- Statut sous forme de Badge -->
                                <div class="flex justify-between items-center">
                                    <flux:badge color="{{ $task['status'] === 'A venir' ? 'yellow' : ($task['status'] === 'Effectué' ? 'green' : 'red') }}">
                                        {{ $task['status'] }}
                                    </flux:badge>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
