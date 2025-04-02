<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <a href="{{ route('plants') }}">
                <x-widget-number-card title="Vos plantes 🪴" :count="auth()->user()->plants->count()" />
            </a>

            <a href="{{ route('tasks.index') }}">
                <x-widget-number-card title="Tâches du jour 📜" :count="auth()->user()->tasksToDoToday()->count()" />
            </a>

            <!-- Placeholder pour future statistique -->
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 flex items-center justify-center">
                <img src="{{ basset('img/flower.jpg') }}" alt="Growth Analytics" />
            </div>
        </div>

        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 text-center flex items-center justify-center">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20"/>
            Soon ⚡
        </div>
    </div>
</x-layouts.app>
