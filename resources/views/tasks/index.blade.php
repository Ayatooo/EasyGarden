<x-layouts.app :title="__('Tâches')">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}" wire:navigate>Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Mes tâches</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="bg-green-50 border-t border-b border-green-300 text-green-600 px-4 py-3 mt-5" role="alert">
        <p class="font-bold">Tâches automatisées 🤖</p>
        <p class="text-sm">
            Tous les jours, des tâches d'arrosage sont générées automatiquement pour vos plantes.
            Vous n'avez plus qu'à les marquer comme terminées !</p>
    </div>
    <flux:separator variant="subtle"/>
</x-layouts.app>
