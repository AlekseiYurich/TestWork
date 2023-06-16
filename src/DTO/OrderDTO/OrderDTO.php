<?php

namespace App\DTO\OrderDTO;

use Prugala\RequestDto\Dto\RequestDtoInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class OrderDTO implements RequestDtoInterface
{
    #[NotBlank]
    public string $customer;
    #[NotBlank]
    public string $status;



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




}