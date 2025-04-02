<div class="space-y-4">
    <div class="flex justify-between items-center">
        <button wire:click="previousMonth" class="text-sm bg-gray-200 dark:bg-zinc-700 px-3 py-1 rounded-md hover:bg-gray-300 dark:hover:bg-zinc-600">
            ⬅ Mois précédent
        </button>
        <h2 class="text-lg font-bold text-gray-800 dark:text-white">
            {{ $currentMonth->translatedFormat('F Y') }}
        </h2>
        <button wire:click="nextMonth" class="text-sm bg-gray-200 dark:bg-zinc-700 px-3 py-1 rounded-md hover:bg-gray-300 dark:hover:bg-zinc-600">
            Mois suivant ➡
        </button>
    </div>

    <div class="grid grid-cols-7 gap-2 text-xs text-center">
        @foreach(['Lun','Mar','Mer','Jeu','Ven','Sam','Dim'] as $day)
            <div class="font-semibold text-gray-700 dark:text-gray-300">{{ $day }}</div>
        @endforeach

        @foreach($days as $day)
            <div class="p-2 border rounded-lg {{ $day['date']->isToday() ? 'border-green-400 border-3' : 'bg-white dark:bg-zinc-800' }}">
                <div class="text-xs font-bold text-gray-700 dark:text-gray-200">
                    {{ $day['date']->format('j') }}
                </div>

                @forelse($day['tasks'] as $task)
                    <div class="mt-1 px-1 py-0.5 {{ $task->bgColor }} text-white text-[10px] rounded">
                        {{ $task->task_type }}
                    </div>
                @empty
                    <div class="text-[10px] text-gray-400 dark:text-gray-500">-</div>
                @endforelse
            </div>
        @endforeach
    </div>
</div>
