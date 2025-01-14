<?php

namespace App\Trait;

trait Filterable
{
    public function scopeFilter($query, array $filters)
    {
        foreach ($filters as $key => $value) {
            if (method_exists($this, $filterMethod = 'filter' . ucfirst($key))) {
                $this->{$filterMethod}($query, $value);
            }
        }
    }
}
