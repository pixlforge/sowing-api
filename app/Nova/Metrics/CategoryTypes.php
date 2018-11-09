<?php

namespace App\Nova\Metrics;

use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;
use App\Models\Category;

class CategoryTypes extends Partition
{
    /**
     * The name displayed on the card.
     *
     * @return string
     */
    public function name()
    {
        return 'Types de catégories';
    }

    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->result([
            'Catégories' => Category::whereNull('parent_id')->count(),
            'Sous-catégories' => Category::whereNotNull('parent_id')->count(),
        ]);
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'category-types';
    }
}
