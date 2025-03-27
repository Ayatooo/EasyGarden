 <div class="flex flex-col gap-6">
    <x-auth-header :title="__('Mot de passe oublié')" :description="__('Entrez votre email pour recevoir un lien de réinitialisation.')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email')"
            type="email"
            required
            autofocus
            placeholder="email@example.com"
        />

        <flux:button variant="primary" type="submit" class="w-full">{{ __('Recevoir un lien') }}</flux:button>
    </form>

    <div class="space-x-1 text-center text-sm text-zinc-400">
        {{ __('Oups, je me souviens de mon mot de passe !') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Se connecter') }}</flux:link>
    </div>
</div>
