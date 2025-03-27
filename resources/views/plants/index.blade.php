<x-layouts.app :title="__('Mon Jardin')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}" wire:navigate>Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">Mon Jardin</flux:breadcrumbs.item>
        </flux:breadcrumbs>

    <flux:separator variant="subtle" class="mb-5"/>

    @livewire('plants.create')

    </div>

</x-layouts.app>
