<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Se connecter à votre compte')" :description="__('Entrez vos informations de connexion pour accéder à votre compte.')"/>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')"/>

    <form wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email')"
            type="email"
            required="true"
            autofocus
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Password -->
        <div class="relative">
            <flux:input
                wire:model="password"
                :label="__('Mot de passe')"
                type="password"
                required="true"
                autocomplete="current-password"
                :placeholder="__('Mot de passe')"
            />

            @if (Route::has('password.request'))
                <flux:link class="absolute right-0 top-0 text-sm" :href="route('password.request')" wire:navigate>
                    {{ __('Mot de passe oublié ?') }}
                </flux:link>
            @endif
        </div>

        <!-- Remember Me -->
        <flux:checkbox wire:model="remember" :label="__('Se souvenir')"/>

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">{{ __('Connexion') }}</flux:button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="space-x-1 text-center text-sm text-zinc-600 dark:text-zinc-400">
            {{ __('Vous n\'avez pas de compte ?') }}
            <flux:link :href="route('register')" wire:navigate>{{ __('S\'inscrire') }}</flux:link>
        </div>
    @endif
</div>
