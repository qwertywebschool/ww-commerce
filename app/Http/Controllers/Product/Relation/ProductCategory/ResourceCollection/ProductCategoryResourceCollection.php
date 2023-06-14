<?php

namespace App\Http\Controllers\Product\Relation\ProductCategory\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResourceCollection extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'slug' => $this->slug ?? null,
            'media' => $this->firstMedia() ?? null,
            'parent_id' => $this->category_id ?? null,
            'parents' => self::collection($this->parents)
        ];
    }
}
