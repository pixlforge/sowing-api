<?php

namespace App\Mail\Password;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Events\Passwords\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetConfirmationEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The user property.
     *
     * @var $event
     */
    public $event;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PasswordReset $event)
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
        return $this->subject(__('emails.reset.subject'))
            ->from('no-reply@sowing.ch')
            ->markdown('emails.passwords.reset');
    }
}
