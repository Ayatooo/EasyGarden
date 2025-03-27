<?php

namespace App\Policies;

use App\Models\ForumReply;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ForumReplyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, ForumReply $forumReply): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, ForumReply $forumReply): bool
    {
    }

    public function delete(User $user, ForumReply $forumReply): bool
    {
    }

    public function restore(User $user, ForumReply $forumReply): bool
    {
    }

    public function forceDelete(User $user, ForumReply $forumReply): bool
    {
    }
}
