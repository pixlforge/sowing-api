<?php

namespace App\Mail\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Events\Users\AccountCreated;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountCreationVerificationEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The content property.
     *
     * @var array
     */
    public $event;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AccountCreated $event)
    {
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@sowing.ch')
            ->subject(__('auth.verification.subject'))
            ->markdown('emails.account.verification');
    }
}
