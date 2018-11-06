<?php

namespace App\Models\Traits;

use App\Scoping\Scoper;
use Illuminate\Database\Eloquent\Builder;

trait CanBeScoped
{
    /**
     * Scope models by the provided scopes.
     *
     * @param Builder $builder
     * @param array $scopes
     * @return Builder
     */
    public function scopeWithScopes(Builder $builder, $scopes = [])
    {
        return (new Scoper(request()))->apply($builder, $scopes);
    }
}
