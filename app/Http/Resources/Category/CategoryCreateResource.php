<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class CategoryCreateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "uuid"        => $this->uuid,
            "name"        => $this->name,
            "slug"        => $this->slug,
            "sub"         => $this->sub,
            "description" => $this->description,
            "created_at"  => $this->created_at->format("Y-m-d H:i:s"),
            "updated_at"  => $this->updated_at->format("Y-m-d H:i:s"),
        ];
    }
}
