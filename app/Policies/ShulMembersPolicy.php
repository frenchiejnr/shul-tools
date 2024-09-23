<?php

namespace App\Policies;

use App\Models\ShulMembers;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ShulMembersPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $currentUser): bool
    {
        return $currentUser->email === 'frenchiejnr@gmail.com';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function edit(User $currentUser, ShulMembers $member): bool
    {
        return $currentUser->email === 'frenchiejnr@gmail.com';
    }
}
