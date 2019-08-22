<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Events\Users\AccountEmailUpdated;

class UserObserver
{
    /**
     * Handle the user "creating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function creating(User $user): void
    {
        $user->password = Hash::make($user->password);
    }

    /**
     * Handle the user "updating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updating(User $user): void
    {
        if ($user->updatedEmail()) {
            $user->email_verified_at = null;
            $user->confirmation_token = User::generateConfirmationToken($user->email);

            AccountEmailUpdated::dispatch($user, request('client_locale'));
        }
    }
}
