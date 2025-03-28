<?php

use App\Http\Controllers\TaskController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantController;

Route::get('/', static function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('garden', 'garden')
    ->middleware(['auth', 'verified'])
    ->name('garden');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
  
    Route::get('plants', [PlantController::class, 'index'])->name('plants');
    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
});

require __DIR__.'/auth.php';
