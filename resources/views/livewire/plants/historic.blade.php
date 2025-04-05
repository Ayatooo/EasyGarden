@php
    use Carbon\Carbon;
    use App\Models\Task;
@endphp

<div>
    <flux:modal.trigger name="historic-plant">
        <flux:button variant="primary" class="cursor-pointer text-white px-4 py-2 rounded-md transition duration-300">Historique</flux:button>
    </flux:modal.trigger>

    <flux:modal name="historic-plant" class="md:w-96 rounded-xl bg-white shadow-xl">
        <div class="space-y-6 p-6">
            <flux:heading size="lg">Historique de la plante</flux:heading>
            <flux:text class="dark:text-white text-gray-600">Voici l'historique des tâches effectuées pour cette plante 🌱</flux:text>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Type</label>
                    <select wire:model.live="filterType"
                            class="w-full rounded-md border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-sm text-gray-800 dark:text-white px-3 py-2">
                        <option value="">Tous</option>
                        @foreach (Task::TYPE_OPTIONS as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end">
                    <button wire:click="resetFilters"
                            class="cursor-pointer w-full inline-flex items-center justify-center px-3 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-white bg-gray-200 hover:bg-gray-300 dark:bg-zinc-700 dark:hover:bg-zinc-600 transition">
                        🔄 Réinitialiser
                    </button>
                </div>
            </div>

            @if(count($tasks) > 0)
                <div class="space-y-6">
                    @php
                        $groupedTasks = $tasks->groupBy(function($task) {
                            return Carbon::parse($task->scheduled_at)->format('Y-m-d');
                        });
                    @endphp

                    @foreach($groupedTasks as $date => $tasksForDate)
                        <div>
                            <p class="text-sm text-gray-500 font-semibold dark:text-emerald-500">
                                {{ ucfirst(Carbon::parse($date)->translatedFormat('l d F Y')) }}
                            </p>

                            <div class="border-b border-gray-300 my-4"></div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($tasksForDate as $task)
                                    @php
                                        $bgColor = '';
                                        switch($task->status) {
                                            case 'Effectué':
                                                $bgColor = 'bg-green-500';
                                                break;
                                            case 'A venir':
                                                $bgColor = 'bg-blue-500';
                                                break;
                                            case 'Annulé':
                                                $bgColor = 'bg-red-500';
                                                break;
                                            default:
                                                $bgColor = 'bg-gray-200';
                                        }
                                    @endphp

                                    <flux:tooltip :content="$task->status" placement="top">
                                        <div class="p-1 {{ $bgColor }} shadow-md rounded-lg hover:shadow-xl transition duration-300 inline-block">
                                            <flux:heading size="md" class="text-white text-center">{{ ucfirst($task->task_type) }}</flux:heading>
                                            <flux:text class="text-sm mt-1 text-white">{{ $task->description }}</flux:text>
                                        </div>
                                    </flux:tooltip>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center mt-4">Aucune tâche enregistrée pour cette plante.</p>
            @endif
        </div>
    </flux:modal>
</div>
