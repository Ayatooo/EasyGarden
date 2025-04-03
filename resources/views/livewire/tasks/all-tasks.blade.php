<div class="relative overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
    <!-- Barre de recherche et filtres -->
    <div class="flex flex-col md:flex-row md:items-end gap-4 p-4 bg-white dark:bg-zinc-800">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Recherche</label>
            <input type="text" wire:model.live.debounce.300ms="search"
                   placeholder="Rechercher une tâche..."
                   class="w-full rounded-md border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-sm text-gray-800 dark:text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <div class="min-w-[160px]">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type</label>
            <select wire:model.live="filterType"
                    class="w-full rounded-md border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-sm text-gray-800 dark:text-white px-3 py-2">
                <option value="">Tous</option>
                <option value="Arrosage">Arrosage</option>
                <option value="Rempotage">Rempotage</option>
                <option value="Taille">Taille</option>
            </select>
        </div>

        <div class="min-w-[160px]">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Statut</label>
            <select wire:model.live="filterStatus"
                    class="w-full rounded-md border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-sm text-gray-800 dark:text-white px-3 py-2">
                <option value="">Tous</option>
                <option value="A venir">À venir</option>
                <option value="Effectué">Effectué</option>
                <option value="Annulé">Annulé</option>
            </select>
        </div>

        <div class="min-w-[160px]">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Plante</label>
            <select wire:model.live="filterPlant"
                    class="w-full rounded-md border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-sm text-gray-800 dark:text-white px-3 py-2">
                <option value="">Toutes</option>
                @foreach($plants as $plant)
                    <option value="{{ $plant->id }}">{{ $plant->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end w-full">
            <button wire:click="resetFilters"
                    class="inline-flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-white bg-gray-200 hover:bg-gray-300 dark:bg-zinc-700 dark:hover:bg-zinc-600 transition">
                🔄 Réinitialiser les filtres
            </button>
        </div>
    </div>

    <!-- Table -->
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs uppercase bg-gray-50 dark:bg-zinc-700 dark:text-gray-300">
        <tr>
            <th class="px-6 py-3 font-medium text-left text-gray-500 dark:text-white tracking-wider uppercase">Type</th>
            <th class="px-6 py-3 font-medium text-left text-gray-500 dark:text-white tracking-wider uppercase">Plante
            </th>
            <th class="px-6 py-3 font-medium text-left text-gray-500 dark:text-white tracking-wider uppercase">Statut
            </th>
            <th class="px-6 py-3 font-medium text-left text-gray-500 dark:text-white tracking-wider uppercase">Date</th>
            <th class="px-6 py-3 font-medium text-left text-gray-500 dark:text-white tracking-wider uppercase">
                Description
            </th>
            <th class="px-6 py-3 text-right font-medium dark:text-white tracking-wider uppercase">Actions</th>
        </tr>
        </thead>
        <tbody class="bg-white dark:bg-zinc-800">
        @forelse($tasks as $task)
            <tr class="{{ $loop->even ? 'bg-emerald-50 dark:bg-zinc-900' : '' }}">
                <td class="px-6 py-4 whitespace-nowrap dark:text-white">{{ $task->task_type }}</td>
                <td class="px-6 py-4 whitespace-nowrap dark:text-white">{{ $task->plant->name ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="inline-block px-2 py-1 rounded text-xs font-medium
                        {{ $task->status === 'A venir' ? 'bg-blue-200 text-blue-800 dark:bg-blue-600 dark:text-white' :
                           ($task->status === 'Effectué' ? 'bg-green-200 text-green-800 dark:bg-green-600 dark:text-white' : 'bg-gray-200') }}">
                        {{ $task->status }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                    {{ $task->scheduled_at ? \Illuminate\Support\Carbon::parse($task->scheduled_at)->translatedFormat('d M Y') : '—' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                    {{ \Illuminate\Support\Str::limit($task->description, 40) }}
                </td>
                <td class="px-6 py-4 text-right">
                    <button wire:click="edit({{ $task->id }})"
                            class="text-green-600 hover:underline text-xs mr-3">
                        Modifier
                    </button>
                    <button wire:click="deleteConfirm({{ $task->id }})"
                            class="text-red-600 hover:underline text-xs">
                        Supprimer
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                    Aucune tâche trouvée.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="p-4">
        {{ $tasks->links() }}
    </div>

</div>
