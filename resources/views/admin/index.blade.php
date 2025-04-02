<x-layouts.app :title="__('Admin 👺')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-2 lg:grid-cols-3">
            <!-- Stat Card -->
            <div
                class="p-5 bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-zinc-700 shadow-sm text-center">
                <h2 class="text-3xl font-bold text-green-600">{{ $usersCount }}</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Utilisateurs inscrits 🙋</p>
            </div>

            <div
                class="p-5 bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-zinc-700 shadow-sm text-center">
                <h2 class="text-3xl font-bold text-green-600">{{ $plantsCount }}</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Plantes ajoutées 💐</p>
            </div>

            <div
                class="p-5 bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-zinc-700 shadow-sm text-center">
                <h2 class="text-3xl font-bold text-green-600">{{ $tasksCount }}</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Tâches générées 📅</p>
            </div>

            <div
                class="p-5 bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-zinc-700 shadow-sm text-center">
                <h2 class="text-3xl font-bold text-green-600">{{ $forumPostsCount }}</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Posts de forum 📜</p>
            </div>

            <div
                class="p-5 bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-zinc-700 shadow-sm text-center">
                <h2 class="text-3xl font-bold text-green-600">{{ $repliesCount }}</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Réponses aux posts 💭</p>
            </div>
        </div>

        <div class="relative overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs uppercase bg-gray-50 dark:bg-zinc-700 dark:text-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-4">Action</th>
                    <th scope="col" class="px-6 py-4">Nom</th>
                    <th scope="col" class="px-6 py-4">Email</th>
                    <th scope="col" class="px-6 py-4">Avatar</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr class="bg-white border-b dark:bg-zinc-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-zinc-700">
                        <td class="px-6 py-3">
                            <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">
                                Impersonate
                            </button>
                        </td>
                        <td class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $user->email }}
                        </td>
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

            <!-- Pagination -->
            <div class="p-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
