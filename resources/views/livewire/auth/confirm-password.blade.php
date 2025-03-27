<div class="flex flex-col gap-6">
    <x-auth-header
        :title="__('Confirmez votre mot de passe')"
        :description="__('Confirmez votre mot de passe pour continuer.')"
    />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="confirmPassword" class="flex flex-col gap-6">
        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Mot de passe')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Mot de passe')"
        />

        <flux:button variant="primary" type="submit" class="w-full">{{ __('Confirmer') }}</flux:button>
    </form>
</div>
