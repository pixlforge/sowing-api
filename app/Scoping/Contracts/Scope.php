<?php

namespace App\Scoping\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface Scope
{
    /**
     * Apply the scope to the query builder.
     *
     * @param Builder $builder
     * @param $value
     * @return mixed
     */
    public function apply(Builder $builder, $value);
}
