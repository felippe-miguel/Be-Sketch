<?php

namespace App\Policies;

use App\Models\Board;
use App\Models\Column;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ColumnPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Column $column): bool
    {
        return $user->id === $column->board->user_id;
    }

    public function update(User $user, Column $column): bool
    {
        return $user->id === $column->board->user_id;
    }

    public function destroy(User $user, Column $column): bool
    {
        return $user->id === $column->board->user_id;
    }
}
