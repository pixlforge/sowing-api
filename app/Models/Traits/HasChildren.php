<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasChildren
{
    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeParents(Builder $builder)
    {
        return $builder->whereNull('parent_id');
    }
}
