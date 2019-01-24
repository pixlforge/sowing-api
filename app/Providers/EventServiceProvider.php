<?php

namespace App\Providers;

use App\Events\Orders\OrderCreated;
use App\Listeners\Orders\EmptyCart;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\Orders\ProcessPayment;
use App\Events\Orders\OrderPaymentFailed;
use App\Listeners\Orders\CreateTransaction;
use App\Events\Orders\OrderPaymentSuccessful;
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
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderCreated::class => [
            ProcessPayment::class,
            EmptyCart::class
        ],
        OrderPaymentFailed::class => [
            MarkOrderAsPaymentFailed::class
        ],
        OrderPaymentSuccessful::class => [
            CreateTransfers::class,
            CreateTransaction::class,
            MarkOrderAsProcessing::class
        ]
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
