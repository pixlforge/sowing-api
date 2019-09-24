<?php

namespace App\Models\Contracts;

interface HasScopesContract
{
    /**
     * Returns an array of scopes by which the model can be scoped.
     *
     * @return array
     */
    public function scopes();
}