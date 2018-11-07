<?php

namespace App\Models;

use App\Money\Money;
use App\Models\Traits\HasPrice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variation extends Model
{
    use SoftDeletes, HasPrice;

    /**
     * Get the model's Money instance price attribute.
     *
     * @param $value
     * @return Money
     */
    public function getPriceAttribute($value)
    {
        if (is_null($value)) {
            return $this->product->price;
        }

        return new Money($value);
    }

    public function priceVaries()
    {
        return $this->price->amount() !== $this->product->price->amount();
    }

    /**
     * Type relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->hasOne(Type::class, 'id', 'type_id');
    }

    /**
     * Product relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
