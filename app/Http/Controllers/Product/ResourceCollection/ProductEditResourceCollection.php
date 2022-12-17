<?php

namespace App\Http\Controllers\Product\ResourceCollection;

use App\Helpers\EnumerationHelper;
use App\Http\Controllers\Product\Enumeration\ProductStatusEnumeration;
use App\Http\Controllers\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Controllers\Product\Relation\Attribute\ResourceCollection\AttributeRelationResourceCollection;
use App\Http\Controllers\Product\Relation\Attribute\ResourceCollection\AttributeResourceCollection;
use App\Http\Controllers\Product\Relation\Brand\Contract\BrandInterface;
use App\Http\Controllers\Product\Relation\Brand\ResourceCollection\BrandResourceCollection;
use App\Http\Controllers\Product\Relation\Category\Contract\CategoryInterface;
use App\Http\Controllers\Product\Relation\Category\ResourceCollection\CategoryCreateResourceCollection;
use App\Http\Controllers\Product\Relation\ProductCategory\ResourceCollection\ProductCategoryResourceCollection;
use App\Http\Controllers\Product\Relation\ProductImage\ResourceCollection\ProductImageResourceCollection;
use App\Http\Controllers\Product\Relation\ProductVariant\ResourceCollection\ProductVariantRelationResourceCollection;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Resources\Json\JsonResource;
use ReflectionException;

class ProductEditResourceCollection extends JsonResource
{
    /**
     * @param $request
     * @return array
     * @throws BindingResolutionException
     * @throws ReflectionException
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'content' => $this->content ?? null,
            'price' => $this->price ?? null,
            'brand' => new BrandResourceCollection($this->brand ?? null),
            'status' => $this->status ?? null,
            'variant_groups' => ProductVariantRelationResourceCollection::collection($this->variants ?? null),
            'categories' => ProductCategoryResourceCollection::collection($this->categories ?? null),
            'attribute_id' => AttributeRelationResourceCollection::collection(app()
                ->make(AttributeInterface::class)
                ->attributes()),
            'category_id' => CategoryCreateResourceCollection::collection(app()
                ->make(CategoryInterface::class)
                ->mainCategoriesWithParents(['id', 'title', 'slug', 'path'])),
            'brand_id' => BrandResourceCollection::collection(app()
                ->make(BrandInterface::class)
                ->brands()),
            'status_type' => EnumerationHelper::enumerationToArray(ProductStatusEnumeration::class)
        ];
    }
}
