<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white antialiased dark:bg-gradient-to-b dark:from-neutral-950 dark:to-neutral-900">
<div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
    <div
        class="relative hidden h-full flex-col p-10 text-white lg:flex dark:border-r dark:border-neutral-800 bg-cover bg-center"
        style="background-image: url('{{ basset('img/login-image.jpg') }}');">

        <div class="absolute inset-0 bg-neutral-900/70"></div>

        <a href="{{ route('home') }}" class="relative z-20 flex items-center text-lg font-medium" wire:navigate>
            <img src="{{ basset('img/logo.png') }}" alt="Logo" class="h-16 w-16">
            {{ config('app.name', 'Laravel') }}
        </a>
    </div>

    <!-- Section droite -->
    <div class="w-full lg:p-8">
        <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
            <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden"
               wire:navigate>
                        <span class="flex h-9 w-9 items-center justify-center rounded-md">
                            <x-app-logo-icon class="size-9 fill-current text-black dark:text-white"/>
                        </span>
                <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
            </a>
            {{ $slot }}
        </div>
    </div>
</div>
@fluxScripts
</body>
</html>
