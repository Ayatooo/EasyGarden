<x-layouts.app :title="__('Tâches')">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}" wire:navigate>Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Mes tâches</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="bg-green-50 border-t border-b border-green-300 text-green-600 px-4 py-3 rounded-lg mt-4" role="alert">
        <p class="font-bold">Tâches automatisées 🤖</p>
        <p class="text-sm">
            Tous les jours, des tâches d'arrosage sont générées automatiquement pour vos plantes.
            Vous n'avez plus qu'à les marquer comme terminées !
        </p>
    </div>

    @if($hasPlants)
        <div class="mt-4">
            @livewire('tasks.create')
        </div>

        <div x-data="{ activeTab: 'today' }" class="mt-4">
            <!-- Onglets -->
            <div class="flex border-b">
                <template x-for="tab in ['today', 'unscheduled', 'all']" :key="tab">
                    <button
                        class="px-4 py-2 text-sm font-semibold focus:outline-none dark:text-white"
                        :class="activeTab === tab ? 'border-b-2 border-green-500 text-green-700' : 'text-gray-500'"
                        x-text="{
                            today: '📅 Tâches du jour',
                            unscheduled: '📌 À planifier',
                            all: '📂 Toutes les tâches'
                        }[tab]"
                        @click="activeTab = tab"
                    ></button>
                </template>
            </div>

            <!-- Contenu -->
            <div class="mt-5">
                <div x-show="activeTab === 'today'">
                    @livewire('tasks.today-task')
                </div>

                <div x-show="activeTab === 'unscheduled'" x-cloak>
                    <div class="relative h-100 flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 text-center flex items-center justify-center">
                        <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20"/>
                        Soon ⚡
                    </div>
                    {{--                    @livewire('tasks.unscheduled-tasks')--}}
                </div>

                <div x-show="activeTab === 'all'" x-cloak>
                    @livewire('tasks.all-tasks')
                </div>
            </div>
        </div>
    @else
        <div class="bg-red-50 border-t border-b border-red-300 text-red-600 px-4 py-3 mt-5 rounded-lg" role="alert">
            <p class="font-bold">Aucune plante enregistrée 🌱</p>
            <p class="text-sm">
                Vous devez ajouter des plantes pour pouvoir créer des tâches d'entretien.
            </p>
        </div>
    @endif
</x-layouts.app>
