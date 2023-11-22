<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(nullable: true)]
    private ?int $rating = null;

    #[ORM\Column(nullable: true)]
    private ?int $likes_count = null;

    #[ORM\Column(nullable: true)]
    private ?int $dislikes_count = null;

    #[ORM\Column(nullable: true)]
    private ?int $helpful_count = null;

    #[ORM\Column(nullable: true)]
    private ?int $reported_count = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getLikesCount(): ?int
    {
        return $this->likes_count;
    }

    public function setLikesCount(?int $likes_count): static
    {
        $this->likes_count = $likes_count;

        return $this;
    }

    public function getDislikesCount(): ?int
    {
        return $this->dislikes_count;
    }

    public function setDislikesCount(?int $dislikes_count): static
    {
        $this->dislikes_count = $dislikes_count;

        return $this;
    }

    public function getHelpfulCount(): ?int
    {
        return $this->helpful_count;
    }

    public function setHelpfulCount(?int $helpful_count): static
    {
        $this->helpful_count = $helpful_count;

        return $this;
    }

    public function getReportedCount(): ?int
    {
        return $this->reported_count;
    }

    public function setReportedCount(?int $reported_count): static
    {
        $this->reported_count = $reported_count;

        return $this;
    }
}
