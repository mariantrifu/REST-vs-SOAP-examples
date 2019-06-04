<?php


namespace App;

interface ProductRepository
{
    public function getAll(): ProductCollection;

    public function getById(ProductId $productId): Product;

    public function save(Product $product): Product;
}