<?php

namespace App\Scoping;

use Illuminate\Http\Request;
use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class Scoper
{
    protected $request;

    /**
     * Scoper constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the provided scopes to the query builder.
     *
     * @param Builder $builder
     * @param array $scopes
     * @return Builder
     */
    public function apply(Builder $builder, array $scopes)
    {
        foreach ($this->limitScopes($scopes) as $key => $scope) {
            if (!$scope instanceof Scope) {
                continue;
            }

            $scope->apply($builder, $this->request->get($key));
        }

        return $builder;
    }

    /**
     * Limit the scopes to those found in the request.
     *
     * @param array $scopes
     * @return array
     */
    protected function limitScopes(array $scopes)
    {
        return array_only($scopes, array_keys($this->request->all()));
    }
}
