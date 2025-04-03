<x-layouts.app :title="$plant->name">
    <div class="flex flex-col lg:flex-row gap-4 lg:h-[calc(100vh-4rem)]">

        <aside class="lg:w-1/4 bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-xl p-4 flex flex-col lg:justify-between">
            <div class="flex flex-col sm:flex-row sm:items-center sm:gap-4 lg:flex-col lg:items-start">
                <img src="{{ $plant->image_url }}" class="w-20 h-20 rounded-full object-cover mx-auto sm:mx-0 lg:mx-auto" alt="{{ $plant->name }}">

                <div class="text-left sm:text-left lg:text-left mt-2 sm:mt-0 lg:mt-4 w-full">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $plant->name }}</h2>
                    <span class="inline-block bg-gray-200 dark:bg-zinc-700 text-xs px-2 py-1 rounded mt-1 mb-4">{{ $plant->type }}</span>
                    <flux:separator/>
                    <ul class="mt-4 mb-4 text-left text-sm text-gray-600 dark:text-gray-300 space-y-1">
                        <li><strong>Exposition :</strong> {{ $plant->sun_exposure }}</li>
                        <li><strong>Type de sol :</strong> {{ $plant->soil_type }}</li>
                        <li><strong>Emplacement :</strong> {{ $plant->location ?? '–' }}</li>
                        <li><strong>Fréquence d’arrosage :</strong> {{ $plant->watering_frequency }} jours</li>
                    </ul>
                    <flux:separator/>
                    <ul class="mt-4 text-left text-sm text-gray-600 dark:text-gray-300 space-y-1">
                        <li><strong>Emplacement :</strong> {{ $plant->location ?? '–' }}</li>
                        <li><strong>Notes :</strong> {{ $plant->notes }} jours</li>
                    </ul>
                </div>
            </div>
        </aside>

        <main class="lg:flex-1">
            <div class="bg-white dark:bg-zinc-800 p-6 rounded-xl border border-gray-200 dark:border-zinc-700 shadow-sm h-full overflow-y-auto">
                <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Historique & planification</h3>
                @livewire('plants.agenda', ['plant' => $plant])
            </div>
        </main>
    </div>
</x-layouts.app>
