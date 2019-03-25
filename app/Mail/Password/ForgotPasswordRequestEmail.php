<?php

namespace App\Mail\Password;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPasswordRequestEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The user property.
     *
     * @var User $user
     */
    public $user;

    /**
     * The token property.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $token)
    {
        $this->user = $user;

        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__('emails.forgot.subject'))
            ->from('no-reply@sowing.ch')
            ->markdown('emails.passwords.forgot');
    }
}
