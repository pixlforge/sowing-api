<?php

namespace App\Providers;

use App\Events\Orders\OrderCreated;
use App\Listeners\Orders\EmptyCart;
use App\Events\Users\AccountCreated;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\Orders\ProcessPayment;
use App\Events\Orders\OrderPaymentFailed;
use App\Listeners\Orders\CreateTransaction;
use App\Events\Orders\OrderPaymentSuccessful;
use App\Listeners\Users\SendConfirmationEmail;
use App\Listeners\Users\SendVerificationEmail;
use App\Listeners\Orders\MarkOrderAsProcessing;
use App\Listeners\Orders\MarkOrderAsPaymentFailed;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        AccountCreated::class => [
            SendConfirmationEmail::class,
            SendVerificationEmail::class
        ],
        OrderCreated::class => [
            ProcessPayment::class,
            EmptyCart::class
        ],
        OrderPaymentFailed::class => [
            MarkOrderAsPaymentFailed::class
        ],
        OrderPaymentSuccessful::class => [
            CreateTransaction::class,
            MarkOrderAsProcessing::class
        ],
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
