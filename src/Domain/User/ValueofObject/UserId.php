<?php

namespace App\Domain\User\ValueObject;

use Stringable;

final class UserId implements Stringable
{
    /**
     * @var string
     */
    private $id;

    private function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function create(string $id): self
    {
        return new self($id);
    }

    public static function createFromInt(int $id): self
    {
        return new self((string)$id);
    }

    public function toInt(): int
    {
        return (int)$this->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}