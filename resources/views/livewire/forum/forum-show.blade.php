<div>
    <!-- Titre du post -->
    <div class="bg-white dark:bg-zinc-700 shadow-sm rounded-lg p-4 mb-4">
        <h2 class="text-xl font-bold">{{ $post->title }}</h2>
        <p class="text-sm text-gray-500 dark:text-white">Posté par {{ $post->user->name }} - {{ $post->created_at->diffForHumans() }}</p>
        <p class="mt-2 text-gray-700 dark:text-white">{{ $post->content }}</p>
    </div>

    <!-- Section Réponses -->
    <div class="mt-6">
        <h3 class="text-lg font-bold mb-2">Réponses</h3>

        @livewire('forum.create-reply', ['forumPostId' => $post->id])

        @foreach($replies as $reply)
            <div class="bg-gray-100 dark:bg-zinc-700 rounded-lg p-3 mt-2">
                <p class="text-sm text-gray-600 dark:text-white">{{ $reply->user->name }} - {{ $reply->created_at->diffForHumans() }}</p>
                <p class="text-gray-700 dark:text-white">{{ $reply->content }}</p>
            </div>
        @endforeach
    </div>
</div>
