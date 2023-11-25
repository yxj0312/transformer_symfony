<?php

namespace App\Entity;

use App\Repository\CouponRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponRepository::class)]
class Coupon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $discount_amount = null;

    #[ORM\Column(length: 255)]
    private ?string $discount_type = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $couponable_id = null;

    #[ORM\Column(length: 255)]
    private ?string $couponable_type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getDiscountAmount(): ?string
    {
        return $this->discount_amount;
    }

    public function setDiscountAmount(string $discount_amount): static
    {
        $this->discount_amount = $discount_amount;

        return $this;
    }

    public function getDiscountType(): ?string
    {
        return $this->discount_type;
    }

    public function setDiscountType(string $discount_type): static
    {
        $this->discount_type = $discount_type;

        return $this;
    }

    public function getCouponableId(): ?string
    {
        return $this->couponable_id;
    }

    public function setCouponableId(string $couponable_id): static
    {
        $this->couponable_id = $couponable_id;

        return $this;
    }

    public function getCouponableType(): ?string
    {
        return $this->couponable_type;
    }

    public function setCouponableType(string $couponable_type): static
    {
        $this->couponable_type = $couponable_type;

        return $this;
    }
}
