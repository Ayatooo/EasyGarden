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
        LogViewer::auth(static function () {
            if (app()->environment('local')) {
                return true;
            }
            $admins = ['louisreynard919@gmail.com', 'mattdinville@gmail.com'];
            if (auth()->check() && in_array(auth()->user()->email, $admins, true)) {
                return true;
            }
            abort(403, 'Vous n\'êtes pas autorisé à accéder à cette page');
        });
    }
}
