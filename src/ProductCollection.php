<?php

namespace App;

class ProductCollection extends \ArrayIterator
{
    protected $products = [];

    /**
     * ProductCollection constructor.
     * @param $products
     */
    public function __construct(array $products = null)
    {
        $this->products = $products;
    }

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function getProducts()
    {
        return $this->products;
    }
}