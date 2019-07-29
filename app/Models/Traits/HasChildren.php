<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasChildren
{
    /**
     * Scope models by top level.
     * 
     * @param Builder $builder
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeParents(Builder $builder)
    {
        return $builder->whereNull('parent_id');
    }

    /**
     * Scope models by those that are not top level.
     *
     * @param Builder $builder
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeChildrenOnly(Builder $builder)
    {
        return $builder->whereNotNull('parent_id');
    }

    /**
     * Scope models by those that are not sections.
     *
     * @param Builder $builder
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeExcludeSections(Builder $builder)
    {
        return $builder->where('is_section', false);
    }
}
