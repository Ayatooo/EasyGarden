<div>
    <!-- Titre du post -->
    <div class="bg-white shadow-sm rounded-lg p-4 mb-4">
        <h2 class="text-xl font-bold">{{ $post->title }}</h2>
        <p class="text-sm text-gray-500">Posté par {{ $post->user->name }} - {{ $post->created_at->diffForHumans() }}</p>
        <p class="mt-2 text-gray-700">{{ $post->content }}</p>
    </div>

    <!-- Section Réponses -->
    <div class="mt-6">
        <h3 class="text-lg font-bold mb-2">Réponses</h3>

        @foreach($replies as $reply)
            <div class="bg-gray-100 rounded-lg p-3 mb-2">
                <p class="text-sm text-gray-600">{{ $reply->user->name }} - {{ $reply->created_at->diffForHumans() }}</p>
                <p class="text-gray-700">{{ $reply->content }}</p>
            </div>
        @endforeach
    </div>
</div>
