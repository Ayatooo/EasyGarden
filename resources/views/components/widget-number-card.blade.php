@props(['title', 'count'])

<div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 flex items-center justify-center">
    <div class="text-center">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-300">
            {{ $title }}
        </h2>
        <p class="text-5xl font-extrabold text-emerald-600 dark:text-emerald-400 mt-2">
            {{ $count }}
        </p>
    </div>
</div>
