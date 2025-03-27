<x-layouts.app :title="__('Tâches')">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}" wire:navigate>Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Mes tâches</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="bg-green-50 border-t border-b border-green-300 text-green-600 px-4 py-3 mt-5" role="alert">
        <p class="font-bold">Tâches automatisées 🤖</p>
        <p class="text-sm">
            Tous les jours, des tâches d'arrosage sont générées automatiquement pour vos plantes.
            Vous n'avez plus qu'à les marquer comme terminées !
        </p>
    </div>

    <flux:separator variant="subtle" class="mb-5"/>

    <div x-data="{ activeTab: 'today' }">
        <!-- Liste des onglets -->
        <div class="flex border-b">
            <button class="px-4 py-2 text-sm font-semibold focus:outline-none"
                    :class="activeTab === 'today' ? 'border-b-2 border-green-500 text-green-700' : 'text-gray-500'"
                    @click="activeTab = 'today'">
                📅 Tâches du jour
            </button>
            <button class="px-4 py-2 text-sm font-semibold focus:outline-none"
                    :class="activeTab === 'future' ? 'border-b-2 border-green-500 text-green-700' : 'text-gray-500'"
                    @click="activeTab = 'future'">
                ⏳ Tâches futures
            </button>
        </div>

        <div class="mt-5">
            <div x-show="activeTab === 'today'">
                @livewire('tasks.create')
                @livewire('tasks.all-task')
            </div>

            <!-- Onglet "Tâches futures" -->
            <div x-show="activeTab === 'future'" x-cloak>
                @livewire('tasks.future-tasks')
            </div>
        </div>
    </div>
</x-layouts.app>
