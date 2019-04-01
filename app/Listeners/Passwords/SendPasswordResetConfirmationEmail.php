<?php

namespace App\Listeners\Passwords;

use Illuminate\Support\Facades\Mail;
use App\Events\Passwords\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Password\PasswordResetConfirmationEmail;

class SendPasswordResetConfirmationEmail implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PasswordReset $event)
    {
        Mail::to($event->user)
            ->locale($event->client_locale)
            ->queue(new PasswordResetConfirmationEmail($event));
    }
}
