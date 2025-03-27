<?php

namespace App\Policies;

use App\Models\Plant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlantPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Plant $plant): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Plant $plant): bool
    {
    }

    public function delete(User $user, Plant $plant): bool
    {
    }

    public function restore(User $user, Plant $plant): bool
    {
    }

    public function forceDelete(User $user, Plant $plant): bool
    {
    }
}
