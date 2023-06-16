<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\SoftDeleteable;

#[SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: true)]
#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 255)]
    private ?string $name = null;
    #[ORM\Column(length: 255)]
    private ?string $description = null;
    #[ORM\Column(length: 255)]
    private ?string $handle = null;
    #[ORM\Column(name: 'deletedAt', type: Types::DATETIME_MUTABLE, nullable: true)]
    private $deletedAt;
    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?LineOrder $orderLine = null;


    public function __construct( ?string $name, ?string $description, ?string $handle, ?LineOrder $orderLine,?int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->handle = $handle;
        $this->orderLine = $orderLine;
    }


    public function getOrderLine(): ?LineOrder
    {
        return $this->orderLine;
    }

    public function setOrderLine(?LineOrder $orderLine): static
    {
        $this->orderLine = $orderLine;

        return $this;
    }


}
