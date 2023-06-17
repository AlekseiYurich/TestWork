<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 255)]

    private ?string $customer;

    #[ORM\Column(length: 255)]
    private ?string $status ;

    #[ORM\OneToMany(mappedBy: 'orderby', targetEntity: LineOrder::class)]
    private Collection $lineOrders;

    public function __construct( ?string $customer  = null, ?string $status= null,?int $id = null)
    {
        $this->id = $id;
        $this->customer = $customer;
        $this->status = $status;
        $this->lineOrders = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }



    public function getLineOrders(): Collection
    {
        return $this->lineOrders;
    }

    public function addLineOrder(LineOrder $lineOrder): static
    {
        if (!$this->lineOrders->contains($lineOrder)) {
            $this->lineOrders->add($lineOrder);
            $lineOrder->setOrderby($this);
        }

        return $this;
    }

    public function removeLineOrder(LineOrder $lineOrder): static
    {
        if ($this->lineOrders->removeElement($lineOrder)) {
            if ($lineOrder->getOrderby() === $this) {
                $lineOrder->setOrderby(null);
            }
        }

        return $this;
    }


    public function setCustomer(?string $customer): Order
    {
        $this->customer = $customer;
        return $this;
    }

    public function setStatus(?string $status): Order
    {
        $this->status = $status;
        return $this;
    }



}
