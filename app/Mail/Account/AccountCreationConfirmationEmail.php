<?php

namespace App\Mail\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Events\Users\AccountCreated;
use Illuminate\Queue\SerializesModels;

class AccountCreationConfirmationEmail extends Mailable
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
            ->markdown('emails.account.confirmation');
    }
}
