<?php

namespace App\Http\Struct\Product\Service;

use App\Helpers\DatatableHelper;
use App\Http\Struct\Product\Contract\ProductInterface;
use Exception;

class ProductService
{
    public function __construct(public ProductInterface $repository)
    {
    }

    /**
     * @throws Exception
     */
    public function index(bool|null $trashed = false): mixed
    {
        return DatatableHelper::datatable($this->repository->products(['id', 'title', 'price', 'slug', 'deleted_at'], $trashed));
    }

    public function productBySlug(string $slug): mixed
    {
        return $this->repository->productBySlug($slug);
    }

    public function store($title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $media): mixed
    {
        return $this->repository->store($title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $media);
    }

    public function edit($id): mixed
    {
        return $this->repository->productById($id);
    }

    public function update($id, $title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $media): mixed
    {
        return $this->repository->update($id, $title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $media);
    }

    public function destroy($id): bool
    {
        return $this->repository->destroy($id);
    }

    public function restore(array $ids): bool
    {
        foreach ($ids as $id) {
            $this->repository->restore($id);
        }

        return true;
    }

    public function forceDelete(array $ids): bool
    {
        foreach ($ids as $id) {
            $this->repository->forceDelete($id);
        }

        return true;
    }
}
