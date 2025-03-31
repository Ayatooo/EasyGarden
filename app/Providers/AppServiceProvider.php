<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LogViewer::auth(function () {
            if (app()->environment('local')) {
                return true;
            }
            if (auth()->check() && auth()->user()->email === 'louisreynard919@gmail.com') {
                return true;
            } else if (auth()->check() && auth()->user()->email === 'mattdinville@gmail.com') {
                return true;
            } else {
                return false;
            }
        });
    }
}
