<div>
    <button
        wire:click="toggleChat"
        class="fixed bottom-4 right-4 inline-flex items-center justify-center text-sm font-medium disabled:pointer-events-none disabled:opacity-50 border rounded-full w-16 h-16 bg-black hover:bg-green-700 m-0 cursor-pointer border-gray-200 p-0 normal-case leading-5 hover:text-gray-900"
        type="button">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="text-white block border-gray-200 align-middle">
            <path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"></path>
        </svg>
    </button>

    @if ($isOpen)
        <div class="fixed bottom-[calc(4rem+1.5rem)] right-0 mr-4 bg-white dark:bg-zinc-700 p-4 rounded-lg border border-[#e5e7eb] w-[90vw] max-w-[440px] h-[80vh] max-h-[634px] shadow-lg flex flex-col">
            <div class="flex flex-col space-y-1.5 pb-3 border-b border-gray-300 dark:border-gray-600">
                <h2 class="font-semibold text-lg tracking-tight">Votre chat avec notre expert jardinier</h2>
            </div>

            <!-- Messages -->
            <div class="flex-1 overflow-auto space-y-3 p-2">
                @if(!$hasMessages)
                    <div class="flex items-start space-x-2 text-sm">
                        <div class="rounded-full bg-gray-100 border p-1">
                            <img src="{{ asset('img/logo.png') }}" alt="Assistant" class="w-6 h-6 rounded-full">
                        </div>
                        <div class="bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-white rounded-lg p-2 max-w-[80%]">
                            <p class="font-bold">N-AIn de Jardin</p>
                            <p>Bonjour mon petit jardinier, comment puis-je t'aider aujourd'hui ?</p>
                        </div>
                    </div>
                @else
                    @foreach($messages as $message)
                        @if($message->role === 'user')
                            <!-- Message Utilisateur -->
                            <div class="flex justify-end text-sm">
                                <div class="bg-green-600 text-white rounded-lg p-2 max-w-[80%]">
                                    <p class="font-bold">Vous</p>
                                    <p>{!! $message->answer  !!}</p>
                                </div>
                            </div>
                        @else
                            <!-- Message Assistant -->
                            <div class="flex items-start space-x-2 text-sm">
                                <div class="rounded-full bg-gray-100 border p-1">
                                    <img src="{{ asset('img/logo.png') }}" alt="Assistant" class="w-6 h-6 rounded-full">
                                </div>
                                <div class="bg-gray-200 dark:bg-zinc-600 text-gray-800 dark:text-white rounded-lg p-2 max-w-[80%]">
                                    <p class="font-bold">N-AIn de Jardin</p>
                                    <p>{!! $message->answer  !!}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>

            @if($waitingResponse)
                <div id="loading-animation" class="text-center text-md font-bold text-gray-500 dark:text-white mb-2">
                    L'Assistant est en train de répondre... 🏄🏻
                </div>
            @endif

            <!-- Input box -->
            <div class="flex items-center pt-2 border-t border-gray-300 dark:border-gray-600">
                <form class="flex items-center justify-center w-full space-x-2">
                    <input
                        wire:model.live="prompt"
                        class="flex h-10 w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-zinc-800 dark:text-white"
                        placeholder="Écrivez votre message ici...">
                    <button
                        wire:click.prevent="sendMessage"
                        class="inline-flex items-center justify-center rounded-md text-sm font-medium text-white bg-green-600 hover:bg-green-700 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2"
                        {{ $waitingResponse ? 'disabled' : '' }}>
                        Envoyer
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>
