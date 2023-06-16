<?php

namespace App\DTO\LineOrderDTO;

use Symfony\Component\Validator\Constraints\NotBlank;

class LineOrderDTO
{
    #[NotBlank]
    public string $article;
    #[NotBlank]
    public string $amountProducts;


    public function getArticle(): string
    {
        return $this->article;
    }

    public function setArticle(string $article): LineOrderDTO
    {
        $this->article = $article;
        return $this;
    }

    public function getAmountProducts(): string
    {
        return $this->amountProducts;
    }


    public function setAmountProducts(string $amountProducts): LineOrderDTO
    {
        $this->amountProducts = $amountProducts;
        return $this;
    }


}