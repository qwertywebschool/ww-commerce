<?php

namespace App\Providers;

use App\Http\Struct\Product\Model\Product;
use App\Http\Struct\Product\Relation\Attribute\Model\Attribute;
use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Model\AttributeValue;
use App\Http\Struct\Product\Relation\Brand\Model\Brand;
use App\Http\Struct\Product\Relation\Category\Model\Category;
use App\Observers\AttributeObserver;
use App\Observers\AttributeValueObserver;
use App\Observers\BrandObserver;
use App\Observers\CategoryObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Brand::observe(BrandObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Attribute::observe(AttributeObserver::class);
        AttributeValue::observe(AttributeValueObserver::class);
    }
}
