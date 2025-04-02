<div class="space-y-4">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
        <button wire:click="previousMonth"
                class="text-sm bg-gray-200 dark:bg-zinc-700 px-3 py-2 rounded-md hover:bg-gray-300 dark:hover:bg-zinc-600 w-full sm:w-auto">
            ⬅ Mois précédent
        </button>

        <h2 class="text-lg font-bold text-center text-gray-800 dark:text-white">
            {{ $currentMonth->translatedFormat('F Y') }}
        </h2>

        <button wire:click="nextMonth"
                class="text-sm bg-gray-200 dark:bg-zinc-700 px-3 py-2 rounded-md hover:bg-gray-300 dark:hover:bg-zinc-600 w-full sm:w-auto">
            Mois suivant ➡
        </button>
    </div>

    <div class="hidden sm:grid grid-cols-7 gap-2 text-xs text-center">
        @foreach(['Lun','Mar','Mer','Jeu','Ven','Sam','Dim'] as $day)
            <div class="font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide text-[11px]">
                {{ $day }}
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-2 text-xs text-center">
        @foreach($days as $day)
            <div class="p-2 border rounded-xl flex flex-col items-center justify-start min-h-[80px] sm:min-h-[100px] {{ $day['date']->isToday() ? 'border-2 border-green-400' : 'bg-white dark:bg-zinc-800' }}">
                <div class="text-xs font-bold text-gray-700 dark:text-gray-200 mb-1">
                    {{ $day['date']->format('j') }}
                </div>

                @forelse($day['tasks'] as $task)
                    <div class="mt-1 px-2 py-1 {{ $task->bgColor ?? 'bg-green-600' }} text-white text-[11px] sm:text-[13px] font-medium rounded-md w-full truncate">
                        {{ $task->task_type }}
                    </div>
                @empty
                    <div class="text-[10px] text-gray-400 dark:text-gray-500">-</div>
                @endforelse
            </div>
        @endforeach
    </div>

</div>
