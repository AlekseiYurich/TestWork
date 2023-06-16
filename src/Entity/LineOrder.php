<?php

namespace App\Entity;

use App\Repository\LineOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LineOrderRepository::class)]
class LineOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'lineOrder', targetEntity: Order::class)]
    private Collection $orders;

    #[ORM\Column(length: 255)]
    private ?string $article = null;

    #[ORM\Column]
    private ?int $amountProducts = null;

    public function __construct( ?string $article, ?int $amountProducts,?int $id = null )
    {
        $this->id = $id;
        $this->article = $article;
        $this->amountProducts = $amountProducts;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setLineOrder($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            if ($order->getLineOrder() === $this) {
                $order->setLineOrder(null);
            }
        }

        return $this;
    }

}
