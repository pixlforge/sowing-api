<?php

namespace App\Listeners\Users;

use App\Events\Users\AccountCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Account\AccountCreationConfirmationEmail;

class SendAccountCreationConfirmationEmail implements ShouldQueue
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
            ->queue(new AccountCreationConfirmationEmail($event));
    }
}
