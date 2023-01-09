<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\ResourceCollection;

use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Contract\AttributeValueInterface;
use App\Http\Controllers\Product\Relation\Attribute\ResourceCollection\AttributeResourceCollection;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeValueEditResourceCollection extends JsonResource
{
    /**
     * @param $request
     * @return array
     * @throws BindingResolutionException
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'code' => $this->code ?? null,
            'path' => asset($this->path ?? null),
            'attribute_id' => $this->attribute_id ?? null,
            'attributes' => AttributeResourceCollection::collection(resolve(AttributeValueInterface::class)
            ->attributeValues()),
        ];
    }
}
