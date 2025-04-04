<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\UploadedFile;

class Profile extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';

    public $avatar; // Peut être null ou UploadedFile
    public $dashboard_image;

    public function mount(): void
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->email = $user->email;

        // Ne pas affecter avatar/dashboard_image (laisser null tant que pas d'upload)
        $this->avatar = null;
        $this->dashboard_image = null;
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'dashboard_image' => ['nullable', 'image', 'max:4096'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Si un nouveau fichier avatar est uploadé
        if ($this->avatar instanceof UploadedFile) {
            $path = Storage::disk('s3')->put('avatars', $this->avatar);
            $user->avatar = $path;
        }

        if ($this->dashboard_image instanceof UploadedFile) {
            $path = Storage::disk('s3')->put('dashboard-images', $this->dashboard_image);
            $user->dashboard_image = $path;
        }

        // Réinitialiser vérification email si changement
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);

        $this->dispatch('refresh');
    }

    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if (!$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
            Session::flash('status', 'verification-link-sent');
        } else {
            $this->redirectIntended(default: route('dashboard', absolute: false));
        }
    }
}
