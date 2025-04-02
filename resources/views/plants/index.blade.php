<x-layouts.app :title="__('Mes plantes')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}" wire:navigate>Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">Mon Jardin</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div class="bg-green-50 border-t border-b border-green-300 text-green-600 px-4 py-3 rounded rounded-lg" role="alert">
            <p class="font-bold">Mes plantes 🪴</p>
            <p class="text-sm">
                Vous pouvez ajouter, modifier ou supprimer vos plantes ici. N'oubliez pas de les arroser régulièrement !
            </p>
        </div>
    @livewire('plants.create')

    @livewire('plants.table')
    </div>

</x-layouts.app>
