<?php

namespace App\Models\Traits;

trait HasDefault
{
    /**
     * Cast the is_default attribute to a boolean.
     *
     * @param mixed $value
     * @return void
     */
    public function setIsDefaultAttribute($value)
    {
        $this->attributes['is_default'] = ($value === 'true' || $value === true || $value == 1 ? true : false);
    }

    /**
     * Checks whether or not the address is the default one.
     *
     * @return boolean
     */
    public function isDefault()
    {
        return (bool) $this->is_default;
    }
}
