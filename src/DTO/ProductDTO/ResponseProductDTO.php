<?php

namespace App\DTO\ProductDTO;

class ResponseProductDTO
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function toArrayById():array
    {
        return ['id'=>$this->id];
    }
}