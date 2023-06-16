<?php

namespace App\DTO\LineOrderDTO;

use Prugala\RequestDto\Dto\RequestDtoInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class LineOrderDTO implements RequestDtoInterface
{
    #[NotBlank]
    public string $article;
    #[NotBlank]
    public int $amountProducts;
    #[NotBlank]
    public array $orders;

    public function getArticle(): string
    {
        return $this->article;
    }

    public function setArticle(string $article): LineOrderDTO
    {
        $this->article = $article;
        return $this;
    }

    public function getAmountProducts(): int
    {
        return $this->amountProducts;
    }


    public function setAmountProducts(int $amountProducts): LineOrderDTO
    {
        $this->amountProducts = $amountProducts;
        return $this;
    }


    public function getOrders(): array
    {
        return $this->orders;
    }


    public function setOrders(array $orders): LineOrderDTO
    {
        $this->orders = $orders;
        return $this;
    }




}