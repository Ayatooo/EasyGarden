<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profil')" :subheading="__('Modifiez vos informations personnelles.')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <flux:input wire:model="name" :label="__('Nom')" type="text" required autofocus autocomplete="name" />

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Vous devez confirmer votre adresse e-mail pour accéder à certaines fonctionnalités de l\'application.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Cliquer ici pour en recevoir un autre.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('Un nouveau lien de vérification a été envoyé à l\'adresse e-mail que vous avez fournie lors de votre inscription.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            @if(auth()->user()->avatar)
                <div class="flex items-center gap-4">
                    <img src="{{ auth()->user()->avatar_url }}"
                         alt="Avatar de {{ auth()->user()->name }}"
                         class="h-12 w-12 rounded-full object-cover border border-gray-300 shadow-sm">
                </div>
            @endif

            <flux:input type="file" wire:model="avatar" :label="__('Photo de profil')" accept="image/*" />


            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Enregistrer') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('C\'est fait ! ✅') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
