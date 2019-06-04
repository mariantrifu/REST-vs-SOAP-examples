<?php

namespace App;

use Ramsey\Uuid\Uuid;

class ProductId implements \JsonSerializable
{
    /**
     * @var string
     */
    private $id;

    /**
     * @param string $id
     */
    public function __construct($id = null)
    {
        $this->id = $id ?: Uuid::uuid4()->toString();
    }
    /**
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id();
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id()
        ];
    }


}