<?php

namespace App\DTO\OrderDTO;

use Symfony\Component\Validator\Constraints\NotBlank;

class OrderDTO
{
    #[NotBlank]
    public string $customer;
    #[NotBlank]
    public string $status;
    #[NotBlank]
    public array $lineOrderId;


    public function getCustomer(): string
    {
        return $this->customer;
    }

    public function setCustomer(string $customer): OrderDTO
    {
        $this->customer = $customer;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }


    public function setStatus(string $status): OrderDTO
    {
        $this->status = $status;
        return $this;
    }

    public function getLineOrderId(): array
    {
        return $this->lineOrderId;
    }


    public function setLineOrderId(array $lineOrderId): OrderDTO
    {
        $this->lineOrderId = $lineOrderId;
        return $this;
    }


}