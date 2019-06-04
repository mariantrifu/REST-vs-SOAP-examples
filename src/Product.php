<?php

namespace App;

class Product implements \JsonSerializable
{
    /**
     * @var ProductId
     */
    protected $productId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * Product constructor.
     * @param ProductId $productId
     * @param string $name
     * @param string $description
     */
    public function __construct(ProductId $productId, string $name,string $description)
    {
        $this->name = $name;
        $this->description = $description;
        $this->productId = $productId;
    }

    /**
     * @return ProductId
     */
    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    public function jsonSerialize()
    {
        return [
            'productId' => $this->getProductId()->id(),
            'name' => $this->getName(),
            'description' => $this->getDescription()
        ];
    }


}