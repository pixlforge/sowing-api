<?php

namespace App\Events\Passwords;

use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class PasswordReset
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The user property
     *
     * @var User $user
     */
    public $user;

    /**
     * The client locale property.
     *
     * @var $client_locale
     */
    public $client_locale;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $client_locale)
    {
        $this->user = $user;
        
        $this->client_locale = $client_locale;
    }
}
