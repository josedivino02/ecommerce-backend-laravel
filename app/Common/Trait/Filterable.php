<?php

namespace App\Common\Trait;

use Illuminate\Database\Eloquent\{Builder, Model};

trait Filterable
{
    /**
     * Apply the filters in the query builder.
     *
     * @param Builder<Model> $query
     * @param array<string, mixed> $filters
     */
    public function scopeFilter($query, array $filters): void
    {
        foreach ($filters as $key => $value) {
            if (method_exists($this, $filterMethod = 'filter' . ucfirst($key))) {
                $this->{$filterMethod}($query, $value);
            }
        }
    }
}
