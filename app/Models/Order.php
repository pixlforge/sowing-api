<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Money\Money;

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
        'payment_method_id',
        'subtotal'
    ];

    /**
     * Get the order subtotal.
     *
     * @param integer $subtotal
     * @return App\Money\Money
     */
    public function getSubtotalAttribute($subtotal)
    {
        return new Money($subtotal);
    }

    /**
     * Get the order total.
     *
     * @return App\Money\Money
     */
    public function total()
    {
        return $this->subtotal->add($this->shippingMethod->price);
    }

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

    /**
     * Payment method relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Variations relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function variations()
    {
        return $this->belongsToMany(Variation::class, 'order_variation')
            ->withPivot(['quantity'])
            ->withTimestamps();
    }

    /**
     * Transactions relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
