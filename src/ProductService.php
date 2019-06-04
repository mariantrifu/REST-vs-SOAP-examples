<?php

namespace App;

class ProductService
{
    /**
     * @var ProductRepository
     */
    private $repository;

    /**
     * ProductService constructor.
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findById(ProductId $productId)
    {
        return $this->repository->getById($productId);
    }

    public function save(Product $product)
    {
        return $this->repository->save($product);
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }
}