<x-layouts.app :title="'Détail de ' . $plant->name">
    <div class="flex gap-6 h-[calc(100vh-4rem)]">

        <aside
            class="w-64 bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-xl p-4 flex flex-col justify-between">
            <div>
                <div class="text-left mb-4">
                    <img src="{{ $plant->image_url }}"
                         class="w-24 h-24 mx-auto rounded-full object-cover" alt="{{ $plant->name }}">
                    <h2 class="mt-2 text-center text-lg font-semibold text-gray-900 dark:text-white">{{ $plant->name }}</h2>
                    <flux:badge class="mt-2">
                        {{ $plant->type }}
                    </flux:badge>
                </div>

                <flux:separator />
                <ul class="text-sm text-gray-600 dark:text-gray-300 space-y-1 mt-3">
                    <li><strong>Exposition :</strong> {{ $plant->sun_exposure }}</li>
                    <li><strong>Type de sol :</strong> {{ $plant->soil_type }}</li>
                    <li><strong>Emplacement :</strong> {{ $plant->location }}</li>
                    <li><strong>Fréquence d’arrosage :</strong> {{ $plant->watering_frequency }} jours</li>
                </ul>
            </div>

            <flux:separator />
            <div class="mt-4 flex flex-col gap-2">
                @livewire('plants.update', ['plant' => $plant], key("update-{$plant->id}"))
                @livewire('plants.delete', ['plant' => $plant], key("delete-{$plant->id}"))
            </div>
        </aside>

        <main class="flex-1">
            <div
                class="bg-white dark:bg-zinc-800 p-6 rounded-xl border border-gray-200 dark:border-zinc-700 shadow-sm h-full overflow-y-auto">
                <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Historique & planification</h3>

                @livewire('plants.agenda', ['plant' => $plant], key("agenda-{$plant->id}"))
            </div>
        </main>
    </div>
</x-layouts.app>
