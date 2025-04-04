@php use Carbon\Carbon; @endphp

<div>
    <flux:modal.trigger name="historic-plant">
        <flux:button class="cursor-pointer bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300">Historique</flux:button>
    </flux:modal.trigger>

    <flux:modal name="historic-plant" class="md:w-96 rounded-xl bg-white shadow-xl">
        <div class="space-y-6 p-6">
            <flux:heading size="lg" class="text-indigo-600">Historique de la plante</flux:heading>
            <flux:text class="mt-2 text-gray-600">Voici l'historique des tâches effectuées pour cette plante 🌱</flux:text>

            @if(count($tasks) > 0)
                <div class="space-y-6">
                    @php
                        $groupedTasks = $tasks->groupBy(function($task) {
                            return Carbon::parse($task->scheduled_at)->format('Y-m-d');
                        });
                    @endphp

                    @foreach($groupedTasks as $date => $tasksForDate)
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">
                                {{ Carbon::parse($date)->translatedFormat('l d F Y') }}
                            </p>

                            <div class="border-b border-gray-300 my-4"></div>

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
                                    <div class="p-4 {{ $bgColor }} shadow-md rounded-lg hover:shadow-xl transition duration-300 mb-4 ">
                                        <flux:heading size="md" class="text-white">{{ ucfirst($task->task_type) }}</flux:heading>
                                        <flux:text class="text-sm mt-1 text-white">{{ $task->description }}</flux:text>
                                    </div>
                                </flux:tooltip>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center mt-4">Aucune tâche enregistrée pour cette plante.</p>
            @endif
        </div>
    </flux:modal>
</div>
