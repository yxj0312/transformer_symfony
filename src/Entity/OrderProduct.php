<?php

namespace App\Entity;

use App\Repository\OrderProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderProductRepository::class)]
class OrderProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $quantity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'orderProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $order = null;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'orderProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(Order $order): static
    {
        $this->order = $order;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): static
    {
        $this->product = $product;

        return $this;
    }
    
}
