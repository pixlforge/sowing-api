<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Mail\Password\ForgotPasswordRequestEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'gateway_customer_id',
        'confirmation_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        Mail::to($this)
            ->locale(App::getLocale())
            ->queue(new ForgotPasswordRequestEmail($this, $token));
    }

    /**
     * Checks whether or not the user owns a shop.
     *
     * @return boolean
     */
    public function hasShop()
    {
        return (bool) $this->shop;
    }

    /**
     * Checks whether or not the user already has a gateway customer id.
     *
     * @return boolean
     */
    public function hasGatewayCustomerId()
    {
        return (bool) $this->gateway_customer_id;
    }

    /**
     * Get the gateway customer id.
     *
     * @return string
     */
    public function getGatewayCustomerId()
    {
        return $this->gateway_customer_id;
    }

    /**
     * Generate a random confirmation token used in email verification.
     *
     * @param string $attribute
     * @return string
     */
    public static function generateConfirmationToken($attribute)
    {
        return md5($attribute);
    }

    /**
     * Get the user confirmation token.
     *
     * @return void
     */
    public function getConfirmationToken()
    {
        return $this->confirmation_token;
    }

    /**
     * User cart relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cart()
    {
        return $this->belongsToMany(Variation::class, 'cart_user')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Addresses relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Orders relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Payment methods relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    /**
     * Shop relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shop()
    {
        return $this->hasOne(Shop::class);
    }
}
