<?php

namespace App\Policies;

use App\Models\ForumPost;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ForumPostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, ForumPost $forumPost): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, ForumPost $forumPost): bool
    {
    }

    public function delete(User $user, ForumPost $forumPost): bool
    {
    }

    public function restore(User $user, ForumPost $forumPost): bool
    {
    }

    public function forceDelete(User $user, ForumPost $forumPost): bool
    {
    }
}
