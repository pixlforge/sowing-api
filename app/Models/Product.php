<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use App\Models\Traits\HasPrice;
use Spatie\MediaLibrary\HasMedia;
use App\Models\Traits\HasScopesTrait;
use App\Scoping\Scopes\CategoryScope;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Contracts\HasScopesContract;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements HasMedia, HasScopesContract
{
    use SoftDeletes, HasScopesTrait, HasPrice, HasTranslations, InteractsWithMedia, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'price'
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatable = [
        'name', 'description',
    ];
    
    /**
     * Key attribute used in routing.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = [
            'name' => [
                'en' => $this->getTranslation('name', 'en'),
                'fr' => $this->getTranslation('name', 'fr'),
                'de' => $this->getTranslation('name', 'de'),
                'it' => $this->getTranslation('name', 'it')
            ],
            'description' => [
                'en' => $this->getTranslation('description', 'en'),
                'fr' => $this->getTranslation('description', 'fr'),
                'de' => $this->getTranslation('description', 'de'),
                'it' => $this->getTranslation('description', 'it')
            ],
            'slug' => $this->slug,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
        
        // Applies Scout Extended default transformations:
        $array = $this->transform($array);
            
        return $array;
    }

    /**
     * Checks whether or not the product has any variation in stock.
     *
     * @return void
     */
    public function inStock()
    {
        return $this->stockCount() > 0;
    }

    /**
     * Return the total stock count for each associated variation.
     *
     * @return mixed
     */
    public function stockCount()
    {
        return $this->variations->sum(function ($variation) {
            return $variation->stockCount();
        });
    }

    /**
     * Returns an array of scopes by which a product can be scoped.
     *
     * @return array
     */
    public function scopes()
    {
        return [
            'category' => new CategoryScope()
        ];
    }

    /**
     * Categories relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Product variation types relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function types()
    {
        return $this->hasMany(ProductVariationType::class);
    }

    /**
     * Variations relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variations()
    {
        return $this->hasMany(ProductVariation::class)->orderBy('order', 'asc');
    }

    /**
     * Shop relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
