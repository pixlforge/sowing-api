<?php

namespace App\Models;

use App\Money\Money;
use App\Models\Traits\HasPrice;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Pivots\ProductVariationStockPivot;
use App\Models\Collections\ProductVariationCollection;

class ProductVariation extends Model
{
    use SoftDeletes, HasPrice, HasTranslations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatable = [
        'name',
        'description',
    ];

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

    /**
     * Checks whether the variation price varies from the base product.
     *
     * @return bool
     */
    public function priceVaries()
    {
        return $this->price->getAmount() !== $this->product->price->getAmount();
    }

    /**
     * Determines which has the least amount of stock.
     *
     * @param integer $quantityInCart
     * @return integer
     */
    public function minStock($quantityInCart)
    {
        return min($this->stockCount(), $quantityInCart);
    }

    /**
     * Checks whether the variation is in stock.
     *
     * @return bool
     */
    public function inStock()
    {
        return $this->stockCount() > 0;
    }

    /**
     * Returns the stock count.
     *
     * @return mixed
     */
    public function stockCount()
    {
        return $this->stock->sum('pivot.stock');
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

    /**
     * Stocks relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    /**
     * Stock relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function stock()
    {
        return $this->belongsToMany(ProductVariation::class, 'product_variation_stock_view')
            ->using(ProductVariationStockPivot::class)
            ->withPivot([
                'stock', 'in_stock'
            ]);
    }

    /**
     * Override the base Eloquent Collection.
     *
     * @param array $models
     * @return App\Models\Collections\ProductVariationCollection
     */
    public function newCollection(array $models = [])
    {
        return new ProductVariationCollection($models);
    }
}
