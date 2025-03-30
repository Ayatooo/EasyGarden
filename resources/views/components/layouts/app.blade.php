<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>
    @livewire('chat-bubble')
</x-layouts.app.sidebar>
