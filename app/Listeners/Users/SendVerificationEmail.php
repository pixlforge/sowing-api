<?php

namespace App\Listeners\Users;

use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Account\EmailAddressVerificationEmail;

class SendVerificationEmail implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to($event->user)
            ->locale($event->client_locale)
            ->queue(new EmailAddressVerificationEmail($event));
    }
}
