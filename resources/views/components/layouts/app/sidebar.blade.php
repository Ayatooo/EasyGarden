<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
<flux:sidebar sticky stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark"/>

    <a href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
        <x-app-logo/>
    </a>

    <flux:navlist variant="outline">
        <flux:navlist.group :heading="__('Menu')" class="grid">
            <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                               wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>

            <flux:navlist.item icon="globe-asia-australia" :href="route('plants')"
                               :current="str_starts_with(request()->path(), 'plants')"
                               wire:navigate>{{ __('Mes plantes') }}</flux:navlist.item>

            <flux:navlist.item icon="calendar" :href="route('tasks.index')" :current="request()->routeIs('tasks.index')"
                               wire:navigate>{{ __('Tâches') }}</flux:navlist.item>

            <flux:navlist.item icon="users" :href="route('forum.index')"
                               :current="str_starts_with(request()->path(), 'forum')"
                               wire:navigate>
                {{ __('Forum') }}
            </flux:navlist.item>

        </flux:navlist.group>
    </flux:navlist>

    <flux:spacer/>

    <flux:navlist variant="outline">
        @if(auth()->user()->isAdmin())
            <flux:navlist.item icon="shield-check" :href="route('admin')"
                               :current="request()->routeIs('admin')"
                               wire:navigate>{{ __('Admin') }}</flux:navlist.item>
        @endif
    </flux:navlist>

    @impersonating
    <div class="bg-red-100 text-red-800 p-3 text-sm">
        ⚠️ Vous êtes en mode assistance
        <a href="{{ route('impersonate.leave') }}" class="underline text-red-900 font-semibold">
            Quitter
        </a>
    </div>
    @endImpersonating

    @if(!auth()->user()->isAdmin())
        @if(auth()->user()->subscribed('premium'))
            <div class="flex items-center justify-start mt-6">
                <span
                    class="inline-flex items-center gap-2 bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300 px-4 py-2 rounded-md text-sm font-semibold shadow-sm">
                    ✅ Abonné Premium
                </span>
            </div>
        @else
            <div
                class="max-w-md mx-auto mt-10 bg-white dark:bg-zinc-800 p-6 rounded-xl shadow-lg text-left border border-gray-200 dark:border-zinc-700">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Passez au Premium 🌿</h2>
                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">
                    Débloquez toutes les fonctionnalités exclusives pour seulement <span
                        class="font-bold text-green-700 dark:text-green-300">5,99€ / mois</span>.
                </p>

                <ul class="text-sm text-left text-gray-500 dark:text-gray-400 mb-6 space-y-1">
                    <li>✔️ Gestion de la santé des plantes</li>
                    <li>✔️ Gestion de vos produits et stocks</li>
                    <li>✔️ Planification avancée des tâches</li>
                    <li>✔️ Support prioritaire</li>
                    <li>✔️ Accès aux futures fonctionnalités</li>
                </ul>

                <a href="{{ route('checkout') }}" class="text-sm text-gray-500 dark:text-gray-400 mb-6 cursor-pointer">
                    <button
                        class="cursor-pointer w-full inline-flex items-center justify-center px-5 py-2.5 bg-green-600 text-white text-sm font-semibold rounded-md hover:bg-green-700 transition duration-150 ease-in-out">
                        🔓 Premium
                    </button>
                </a>
            </div>
        @endif
    @endif

    <!-- Desktop User Menu -->
    <flux:dropdown position="bottom" align="start">
        <flux:profile
            :name="auth()->user()->name"
            :initials="auth()->user()->initials()"
            icon-trailing="chevrons-up-down"
        />
        <flux:menu class="w-[220px]">
            <flux:menu.radio.group>
                <div class="p-0 text-sm font-normal">
                    <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                        <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <img src="{{ auth()->user()->avatar_url }}" alt="Avatar de {{ auth()->user()->name }}"
                                     class="h-full w-full object-cover rounded-lg">
                        </span>
                        <div class="grid flex-1 text-left text-sm leading-tight">
                            <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                            <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                </div>
            </flux:menu.radio.group>


            <flux:menu.separator/>

            <flux:menu.radio.group>
                <flux:menu.item :href="route('settings.profile')" icon="cog"
                                wire:navigate>{{ __('Paramètres') }}</flux:menu.item>
            </flux:menu.radio.group>

            <flux:menu.separator/>

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                    {{ __('Déconnexion') }}
                </flux:menu.item>
            </form>
        </flux:menu>
    </flux:dropdown>
</flux:sidebar>

<!-- Mobile User Menu -->
<flux:header class="lg:hidden">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left"/>

    <flux:spacer/>

    <flux:dropdown position="top" align="end">
        <flux:profile
            :initials="auth()->user()->initials()"
            icon-trailing="chevron-down"
        />

        <flux:menu>
            <flux:menu.radio.group>
                <div class="p-0 text-sm font-normal">
                    <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                        <div class="grid flex-1 text-left text-sm leading-tight">
                            <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                            <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                </div>
            </flux:menu.radio.group>

            <flux:menu.separator/>

            <flux:menu.radio.group>
                <flux:menu.item :href="route('settings.profile')" icon="cog"
                                wire:navigate>{{ __('Settings') }}</flux:menu.item>
            </flux:menu.radio.group>

            <flux:menu.separator/>

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                    {{ __('Log Out') }}
                </flux:menu.item>
            </form>
        </flux:menu>
    </flux:dropdown>
</flux:header>

{{ $slot }}

@fluxScripts
</body>
</html>
