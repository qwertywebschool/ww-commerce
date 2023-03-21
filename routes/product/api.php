<?php

use App\Http\Controllers\Product\Controller\ProductController;
use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::PRODUCT_GROUP)->prefix(RouteGroupPathEnumeration::PRODUCT_GROUP)->group(function ($router){
    $router->controller(ProductController::class)->group(function ($router){
        $router->post('/', 'index')->name('index')->middleware(['auth:sanctum', 'permission:product.index']);
        $router->get('/create', 'create')->name('create')->middleware(['auth:sanctum', 'permission:product.create']);
        $router->post('/store', 'store')->name('store')->middleware(['auth:sanctum', 'permission:product.store']);
        $router->patch('/{id}', 'update')->name('update')->middleware(['auth:sanctum', 'permission:product.update']);
        $router->get('/{id}/edit', 'edit')->name('edit')->middleware(['auth:sanctum', 'permission:product.edit']);
        $router->delete('/{id}/destroy', 'destroy')->name('destroy')->middleware(['auth:sanctum', 'permission:product.destroy']);
        $router->get('/{slug}', 'show')->name('show');
    });
});
