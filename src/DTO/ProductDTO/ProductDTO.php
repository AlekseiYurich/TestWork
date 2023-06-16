<?php

namespace App\DTO\ProductDTO;

use Prugala\RequestDto\Dto\RequestDtoInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProductDTO implements RequestDtoInterface
{
    #[Length(min: 1)]
    #[NotBlank]
    public string $name;
    #[NotBlank]
    public string $description;
    #[NotBlank]
    public string $handle;
    #[NotBlank]
    public array $orderLineId;


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ProductDTO
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): ProductDTO
    {
        $this->description = $description;
        return $this;
    }

    public function getHandle(): string
    {
        return $this->handle;
    }

    public function setHandle(string $handle): ProductDTO
    {
        $this->handle = $handle;
        return $this;
    }

    public function getOrderLineId(): array
    {
        return $this->orderLineId;
    }

    public function setOrderLineId(array $orderLineId): ProductDTO
    {
        $this->orderLineId = $orderLineId;
        return $this;
    }




}