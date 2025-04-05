<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profil')" :subheading="__('Modifiez vos informations personnelles.')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <flux:input wire:model="name" :label="__('Nom')" type="text" required autofocus autocomplete="name" />
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />
            </div>

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                <div class="rounded-lg bg-yellow-50 dark:bg-yellow-900/30 p-4 border border-yellow-300 dark:border-yellow-600 text-sm text-yellow-800 dark:text-yellow-100 space-y-2">
                    <p>{{ __('Vous devez confirmer votre adresse e-mail pour accéder à certaines fonctionnalités de l\'application.') }}</p>

                    <flux:link class="text-sm font-medium underline cursor-pointer" wire:click.prevent="resendVerificationNotification">
                        {{ __('Cliquez ici pour recevoir un nouveau lien de vérification.') }}
                    </flux:link>

                    @if (session('status') === 'verification-link-sent')
                        <p class="font-medium text-emerald-600 dark:text-emerald-400">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                <flux:input type="file" wire:model="avatar" :label="__('Photo de profil')" accept="image/*" />

                @if ($avatar)
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">{{ __('Aperçu de la nouvelle photo :') }}</p>
                        <img src="{{ $avatar->temporaryUrl() }}" alt="Preview Avatar" class="h-16 w-16 rounded-full object-cover border mt-1 shadow">
                    </div>
                @elseif(auth()->user()->avatar_url)
                    {{-- Sinon, avatar actuel --}}
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">{{ __('Photo actuelle :') }}</p>
                        <img src="{{ auth()->user()->avatar_url }}" alt="Avatar actuel" class="h-16 w-16 rounded-full object-cover border mt-1 shadow">
                    </div>
                @endif

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                <flux:input type="file" wire:model="dashboard_image" :label="__('Photo du dashboard')" accept="image/*" />

                @if ($dashboard_image)
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">{{ __('Aperçu de la nouvelle image :') }}</p>
                        <img src="{{ $dashboard_image->temporaryUrl() }}" alt="Preview dashboard" class="h-32 w-32 rounded-md object-cover border mt-1 shadow">
                    </div>
                @elseif(auth()->user()->dashboard_image_url)
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">{{ __('Image actuelle :') }}</p>
                        <img src="{{ auth()->user()->dashboard_image_url }}" alt="Dashboard actuel" class="h-32 w-32 rounded-md object-cover mt-1 shadow">
                    </div>
                @endif

            </div>

            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <flux:button variant="primary" type="submit" class="w-full md:w-auto">
                    {{ __('Enregistrer') }}
                </flux:button>

                <x-action-message class="text-emerald-600 dark:text-emerald-400" on="profile-updated">
                    {{ __('C\'est fait ! ✅') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
