@php use App\Models\ForumPost; @endphp
<div>
    <div class="mb-4 flex items-center space-x-4">
        @livewire('forum.create')

        <select wire:model.live="selectedCategory" class="border p-2 rounded dark:bg-zinc-800 dark:text-white text-gray-700 bg-white">
            <option value="">Toutes les catégories</option>
            @foreach(App\Models\ForumPost::CATEGORIES as $category)
                <option value="{{ $category }}">{{ ucfirst($category) }}</option>
            @endforeach
        </select>
    </div>

    <div class="space-y-4">
        @foreach($posts as $post)
            <div class="bg-white dark:bg-zinc-700 shadow-sm rounded-lg p-4">
                <a href="{{ route('forum.show', $post->id) }}" class="block">
                    <h2 class="text-lg font-bold">
                        <span class="bg-emerald-100 text-emerald-800 text-sm font-medium p-2 rounded dark:bg-emerald-900 dark:text-emerald-300 mr-2">
                            {{ $post->category }}
                        </span>
                        {{ $post->title }}
                    </h2>
                    <p class="mt-2 text-gray-700 dark:text-white">{{ Str::limit($post->content) }}</p>
                    <p class="text-sm text-gray-500 dark:text-white">Posté par {{ $post->user->name }}
                        - {{ $post->created_at->diffForHumans() }}</p>
                </a>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
