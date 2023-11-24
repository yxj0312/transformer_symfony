<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $session_id = null;

    #[ORM\Column]
    private ?int $total_items = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $total_price = null;

    #[ORM\Column(length: 255)]
    private ?string $decimal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coupon_code = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column]
    private ?bool $is_checked_out = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $checked_out_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSessionId(): ?string
    {
        return $this->session_id;
    }

    public function setSessionId(?string $session_id): static
    {
        $this->session_id = $session_id;

        return $this;
    }

    public function getTotalItems(): ?int
    {
        return $this->total_items;
    }

    public function setTotalItems(int $total_items): static
    {
        $this->total_items = $total_items;

        return $this;
    }

    public function getTotalPrice(): ?string
    {
        return $this->total_price;
    }

    public function setTotalPrice(string $total_price): static
    {
        $this->total_price = $total_price;

        return $this;
    }

    public function getDecimal(): ?string
    {
        return $this->decimal;
    }

    public function setDecimal(string $decimal): static
    {
        $this->decimal = $decimal;

        return $this;
    }

    public function getCouponCode(): ?string
    {
        return $this->coupon_code;
    }

    public function setCouponCode(?string $coupon_code): static
    {
        $this->coupon_code = $coupon_code;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    public function isIsCheckedOut(): ?bool
    {
        return $this->is_checked_out;
    }

    public function setIsCheckedOut(bool $is_checked_out): static
    {
        $this->is_checked_out = $is_checked_out;

        return $this;
    }

    public function getCheckedOutAt(): ?\DateTimeImmutable
    {
        return $this->checked_out_at;
    }

    public function setCheckedOutAt(?\DateTimeImmutable $checked_out_at): static
    {
        $this->checked_out_at = $checked_out_at;

        return $this;
    }
}
