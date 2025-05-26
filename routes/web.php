<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TaskController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantController;

Route::get('/', static function () {
    return view('welcome');
})->name('home');

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


/*** ROUTES ASSISTANCE ***/
Route::get('/impersonate/{id}', static function ($id) {
    $user = User::findOrFail($id);

    abort_unless(auth()->user()->isAdmin(), 403);

    auth()->user()->impersonate($user);

    return redirect('/dashboard');
})->middleware('auth')->name('impersonate');

Route::get('/leave-impersonation', static function () {
    auth()->user()->leaveImpersonation();

    return redirect('/admin');
})->middleware('auth')->name('impersonate.leave');
/*** FIN DES ROUTES ASSISTANCE ***/


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('plants', [PlantController::class, 'index'])->name('plants');
    Route::get('/plants/{plant}', [PlantController::class, 'show'])->name('plants.show');

    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('forum/{postId}', [ForumController::class, 'show'])->name('forum.show');


    Route::get('/checkout', [SubscriptionController::class, 'show'])
        ->name('checkout')
        ->middleware(['auth', 'verified']);
});

require __DIR__ . '/auth.php';
