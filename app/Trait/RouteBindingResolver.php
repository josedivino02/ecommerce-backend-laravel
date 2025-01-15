<?php

namespace App\Trait;

use Symfony\Component\HttpFoundation\Response;

trait RouteBindingResolver
{
    public function resolveRouteBinding($value, $field = null)
    {
        $model = $this->where($field ?? "id", $value)->first();

        if (!$model) {
            abort(response()->json([
                "error" => "The " . class_basename($this) . " was not found",
            ], Response::HTTP_NOT_FOUND));
        }

        return $model;
    }
}
