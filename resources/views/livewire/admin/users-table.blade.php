<div class="space-y-4">
    <div class="flex justify-between items-center px-2">
        <input
            wire:model.live.debounce.300ms="search"
            type="text"
            placeholder="Rechercher par nom ou email..."
            class="w-full md:w-1/3 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-400"
        />
    </div>

    <div class="relative overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-zinc-700 dark:text-gray-300">
            <tr>
                <th class="px-6 py-4">Action</th>
                <th class="px-6 py-4">Nom</th>
                <th class="px-6 py-4">Email</th>
                <th class="px-6 py-4">Avatar</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr class="bg-white border-b dark:bg-zinc-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-zinc-700">
                    <td class="px-6 py-3">
                        <a href="{{ route('impersonate', $user->id) }}"
                           class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">
                            Assister
                        </a>
                    </td>
                    <td class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                        {{ $user->name }}
                    </td>
                    <td class="px-6 py-3">{{ $user->email }}</td>
                    <td class="px-6 py-3">
                        <img src="{{ $user->avatar_url }}" alt="Avatar"
                             class="w-8 h-8 rounded-full object-cover">
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Aucun utilisateur trouvé.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        @if($users->hasPages())
            <div class="p-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
