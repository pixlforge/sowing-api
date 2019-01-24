<?php

namespace App\Listeners\Orders;

use Illuminate\Contracts\Queue\ShouldQueue;

class CreateTransfers implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // $transfer = StripeTransfer::create([
        //     'amount' => 9000,
        //     'currency' => 'chf',
        //     'source_transaction' => $charge->id,
        //     'destination' => 'acct_1DuweIJRGunS1HAY'
        // ]);
    }
}
