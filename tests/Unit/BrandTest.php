<?php

namespace Tests\Unit;

use App\Http\Struct\Media\Model\Media;
use App\Http\Struct\Product\Relation\Brand\Model\Brand;
use Tests\TestCase;

class BrandTest extends TestCase
{
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->model = resolve(Brand::class);
    }

    public function test_can_index_brand(): void
    {
        $this->assertIsObject($this->post(route('brand.index'), [])->getOriginalContent());
    }

    public function test_can_create_brand(): void
    {
        $this->assertTrue(true);
    }

    public function test_can_store_brand(): void
    {
        $brand = $this->post(route('brand.store'), [
            'title' => $this->faker->name,
            'media' => Media::first()->toArray(),
        ])->assertStatus(200)->getOriginalContent();
        self::$id = $brand['data']['id'];
    }

    public function test_can_edit_brand(): void
    {
        $this->get(route('brand.edit', self::$id))->assertStatus(200);
    }

    public function test_can_update_brand(): void
    {
        $this->patch(route('brand.update', self::$id), [
            'title' => $this->faker->name,
            'media' => Media::first()->toArray(),
        ])->assertStatus(200);
    }

    public function test_can_destroy_brand(): void
    {
        $this->delete(route('brand.destroy', self::$id))->assertStatus(200);
    }

    public function test_can_force_brand(): void
    {
        $this->assertTrue($this->model->find(self::$id)->forceDelete());
    }
}
