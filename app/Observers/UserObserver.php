<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Events\Users\AccountEmailUpdated;
use App\Events\Users\AccountPasswordUpdated;

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
        $this->hashPassword($user);
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
        
        $this->hashPassword($user);

        if ($user->updatedPassword()) {
            AccountPasswordUpdated::dispatch($user, request('client_locale'));
        }
    }

    /**
     * Hash the user's password.
     *
     * @param User $user
     * @return void
     */
    protected function hashPassword(User $user)
    {
        $user->password = Hash::make($user->password);
    }
}
