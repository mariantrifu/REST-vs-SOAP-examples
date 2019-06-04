<?php

namespace App;

class PdoProductRepository implements ProductRepository
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * PdoProductRepository constructor.
     */
    public function __construct()
    {
        $this->pdo = new \PDO('sqlite:/tmp/temp.db');
        $this->pdo->query("CREATE TABLE IF NOT EXISTS products(productId VARCHAR(255) PRIMARY KEY NOT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL)");
    }

    public function getById(ProductId $productId): Product
    {
        $sql = 'SELECT * from products where productId = :productId';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(
            ['productId' => $productId->id()]
        );

        return $statement->fetchObject(Product::class, [new ProductId('productId'), 'name', 'description']);
    }

    public function save(Product $product): Product
    {
        $sql = 'INSERT INTO products VALUES(:productId, :name, :description)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'productId'   => $product->getProductId()->id(),
            'name'        => $product->getName(),
            'description' => $product->getDescription()
        ]);
        return $product;
    }

    public function getAll(): ProductCollection
    {
        $sql = "SELECT * FROM products";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        $collection = new ProductCollection();
        foreach($statement->fetchAll() as $p){
            $collection->addProduct(
                new Product(
                    new ProductId($p['productId']),
                    $p['name'],
                    $p['description']
                )
            );
        }

        return $collection;
    }


}