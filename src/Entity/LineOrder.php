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
    #[ORM\Column(length: 255)]
    private ?int $article = null;
    #[ORM\Column]
    private ?int $amountProducts = null;

    #[ORM\OneToMany(mappedBy: 'orderLine', targetEntity: Product::class)]
    private Collection $products;

    #[ORM\ManyToOne(inversedBy: 'lineOrders')]
    private ?Order $orderby = null;


    public function __construct(?int $article, ?int $amountProducts, ?Order $orderby, ?int $id = null)
    {
        $this->id = $id;
        $this->article = $article;
        $this->amountProducts = $amountProducts;
        $this->products = new ArrayCollection();
        $this->orderby = $orderby;
    }


    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setOrderLine($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->products->removeElement($product)) {
            if ($product->getOrderLine() === $this) {
                $product->setOrderLine(null);
            }
        }

        return $this;
    }

    public function getOrderby(): ?Order
    {
        return $this->orderby;
    }

    public function setOrderby(?Order $orderby): static
    {
        $this->orderby = $orderby;

        return $this;
    }




}
