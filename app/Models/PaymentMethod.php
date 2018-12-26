<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'card_type',
        'last_four',
        'provider_id',
        'is_default',
    ];

    /**
     * The attributes that are cast.
     *
     * @var array
     */
    protected $casts = [
        'is_default' => 'boolean'
    ];

    /**
     * Cast the is_default attribute to a boolean.
     *
     * @param mixed $value
     * @return void
     */
    public function setIsDefaultAttribute($value)
    {
        $this->attributes['is_default'] = ($value === 'true' || $value === true || $value == 1 ? true : false);
    }

    /**
     * Checks whether or not the address is the default one.
     *
     * @return boolean
     */
    public function isDefault()
    {
        return $this->is_default;
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
}
