<?php

namespace App\Events\Users;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\User;

class AccountCreated
{
    use Dispatchable, SerializesModels;

    /**
     * The user property.
     *
     * @var $user
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
