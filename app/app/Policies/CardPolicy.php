<?php

namespace App\Policies;

use App\Models\Card;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CardPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Card $card): bool
    {
        return $user->id === $card->user_id;
    }

    public function update(User $user, Card $card): bool
    {
        return $user->id === $card->user_id;
    }

    public function destroy(User $user, Card $card): bool
    {
        return $user->id === $card->user_id;
    }
}
