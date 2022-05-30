<?php

namespace App\Policies;

use App\Models\Board;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BoardPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Board $board): bool
    {
        return $user->id === $board->user_id;
    }

    public function update(User $user, Board $board): bool
    {
        return $user->id === $board->user_id;
    }

    public function destroy(User $user, Board $board): bool
    {
        return $user->id === $board->user_id;
    }
}
