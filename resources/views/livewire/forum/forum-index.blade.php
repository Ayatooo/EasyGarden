@php use App\Models\ForumPost; @endphp
<div>
    <div class="mb-4 flex items-center space-x-4">
        @livewire('forum.create')

        <select wire:model.live="selectedCategory" class="border p-2 rounded">
            <option value="">Toutes les catégories</option>
            @foreach(App\Models\ForumPost::CATEGORIES as $category)
                <option value="{{ $category }}">{{ ucfirst($category) }}</option>
            @endforeach
        </select>
    </div>

    <div class="space-y-4">
        @foreach($posts as $post)
            <div class="bg-white shadow-sm rounded-lg p-4">
                <a href="{{ route('forum.show', $post->id) }}" class="block">
                    <h2 class="text-lg font-bold">
                        <flux:badge color="emerald">
                            {{ $post->category }}
                        </flux:badge>
                        {{ $post->title }}
                    </h2>
                    <p class="mt-2 text-gray-700">{{ Str::limit($post->content) }}</p>
                    <p class="text-sm text-gray-500">Posté par {{ $post->user->name }}
                        - {{ $post->created_at->diffForHumans() }}</p>
                </a>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
