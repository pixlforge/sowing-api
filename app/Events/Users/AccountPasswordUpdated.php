<?php

namespace App\Events\Users;

use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class AccountPasswordUpdated
{
    use Dispatchable, SerializesModels;

    /**
     * The user property.
     *
     * @var $user
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
