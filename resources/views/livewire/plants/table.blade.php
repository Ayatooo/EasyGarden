<div class="overflow-x-auto"
     wire:listener="refreshPlantsTable">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Actions
            </th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Image
            </th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Nom
            </th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Type
            </th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Fréquence d'arrosage
            </th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Exposition
            </th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Type de sol
            </th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Notes
            </th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @forelse($plants as $index => $plant)
            <tr class="{{ $loop->even ? 'bg-emerald-50' : '' }}">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    <div class="flex gap-4">
                        @livewire('plants.update', ['plant' => $plant], key("update-{$plant->id}-{$index}"))
                        @livewire('plants.delete', ['plant' => $plant], key("delete-{$plant->id}-{$index}"))
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    <img src="{{ $plant->image_url }}"
                         alt="{{ ucfirst($plant->name[0]) }}"
                         class="w-10 h-10 object-cover rounded-full">
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    {{ $plant->name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $plant->type }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $plant->watering_frequency }} jours
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $plant->sun_exposure }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $plant->soil_type }}
                </td>
                <td class="px-6 py-4 text-sm text-gray-500">
                    {{ Str::limit($plant->notes, 50) }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6"
                    class="px-6 py-4 text-center text-sm text-gray-500">
                    Aucune plante trouvée
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $plants->links() }}
    </div>
</div>
