<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait IsOrderable
{
    /**
     * @param Builder $builder
     * @param string $direction
     * @return Builder
     */
    public function scopeOrdered(Builder $builder, $direction = 'asc')
    {
        return $builder->orderBy('order', $direction);
    }
}
