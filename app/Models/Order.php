<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Pending order status
     *
     * @var PENDING
     */
    const PENDING = 'pending';

    /**
     * Processing order status
     *
     * @var PROCESSING
     */
    const PROCESSING = 'processing';

    /**
     * Payment failed order status
     *
     * @var PAYMENT_FAILED
     */
    const PAYMENT_FAILED = 'payment_failed';

    /**
     * Completed order status
     *
     * @var COMPLETED
     */
    const COMPLETED = 'completed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'address_id',
        'shipping_method_id',
        'subtotal'
    ];

    /**
     * User relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Address relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Shipping method relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class);
    }
}
