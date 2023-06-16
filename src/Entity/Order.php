<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'orderBy', targetEntity: Product::class)]
    private Collection $products;

    #[ORM\Column(length: 255)]
    private ?string $customer = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?LineOrder $lineOrder = null;

    public function __construct(?string $customer, ?string $status, ?LineOrder $lineOrder, ?int $id = null)
    {
        $this->id = $id;
        $this->products = new ArrayCollection();
        $this->customer = $customer;
        $this->status = $status;
        $this->lineOrder = $lineOrder;
    }


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setOrderBy($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->products->removeElement($product)) {
            if ($product->getOrderBy() === $this) {
                $product->setOrderBy(null);
            }
        }

        return $this;
    }


    public function getLineOrder(): ?LineOrder
    {
        return $this->lineOrder;
    }

    public function setLineOrder(?LineOrder $lineOrder): static
    {
        $this->lineOrder = $lineOrder;

        return $this;
    }
}
