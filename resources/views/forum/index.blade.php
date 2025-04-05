<x-layouts.app :title="__('Forum')">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}" wire:navigate>Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Forum</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="bg-green-50 border-t border-b border-green-300 text-emerald-600 px-4 py-3 rounded rounded-lg mt-4" role="alert">
        <p class="font-bold">Forum 🧿</p>
        <p class="text-sm">
            Vous pouvez poser des questions, répondre à des questions, et discuter de tout ce qui concerne votre jardin.
        </p>
    </div>

    <div class="mt-4">
        @livewire('forum.forum-index')
    </div>
</x-layouts.app>
