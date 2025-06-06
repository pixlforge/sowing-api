<?php

namespace App\Listeners\Users;

use Illuminate\Support\Facades\Mail;
use App\Events\Users\AccountCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Account\AccountCreationConfirmationEmail;

class SendConfirmationEmail implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param AccountCreated $event
     * @return void
     */
    public function handle(AccountCreated $event)
    {
        Mail::to($event->user)
            ->locale($event->client_locale)
            ->queue(new AccountCreationConfirmationEmail($event));
    }
}
