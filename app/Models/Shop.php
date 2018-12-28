<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Shop extends Model implements HasMedia
{
    use HasTranslations, SoftDeletes, HasMediaTrait;

    /**
     * Green theme color.
     *
     * @var THEME_GREEN
     */
    const THEME_GREEN = '#5FB881';

    /**
     * Pink theme color.
     *
     * @var THEME_PINK
     */
    const THEME_PINK = '#F06292';

    /**
     * Purple theme color.
     *
     * @var THEME_PURPLE
     */
    const THEME_PURPLE = '#7E57C2';

    /**
     * Indigo theme color.
     *
     * @var THEME_INDIGO
     */
    const THEME_INDIGO = '#5C6BC0';

    /**
     * Blue theme color.
     *
     * @var THEME_BLUE
     */
    const THEME_BLUE = '#42A5F5';

    /**
     * Brown theme color.
     *
     * @var THEME_BROWN
     */
    const THEME_BROWN = '#795548';

    /**
     * Grey theme color.
     *
     * @var THEME_GREY
     */
    const THEME_GREY = '#424242';

    /**
     * Slate theme color.
     *
     * @var THEME_SLATE
     */
    const THEME_SLATE = '#546E7A';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description_short',
        'description_long',
        'theme_color',
        'postal_code',
        'city',
        'country_id'
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatable = [
        'description_short',
        'description_long',
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
     * User relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Country relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
