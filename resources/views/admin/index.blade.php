<x-layouts.app :title="__('Admin 👺')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-2 lg:grid-cols-3">
            <!-- Stat Card -->
            <div class="p-5 bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-zinc-700 shadow-sm text-center">
                <h2 class="text-3xl font-bold text-green-600">{{ $users }}</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Utilisateurs inscrits 🙋</p>
            </div>

            <div class="p-5 bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-zinc-700 shadow-sm text-center">
                <h2 class="text-3xl font-bold text-green-600">{{ $plants }}</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Plantes ajoutées 💐</p>
            </div>

            <div class="p-5 bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-zinc-700 shadow-sm text-center">
                <h2 class="text-3xl font-bold text-green-600">{{ $tasks }}</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Tâches générées 📅</p>
            </div>

            <div class="p-5 bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-zinc-700 shadow-sm text-center">
                <h2 class="text-3xl font-bold text-green-600">{{ $forumPosts }}</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Posts de forum 📜</p>
            </div>

            <div class="p-5 bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-zinc-700 shadow-sm text-center">
                <h2 class="text-3xl font-bold text-green-600">{{ $replies }}</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Réponses aux posts 💭</p>
            </div>
        </div>

        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 text-center flex items-center justify-center">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20"/>
            D'autres infos arrivent bientôt ⚡
        </div>
    </div>
</x-layouts.app>
