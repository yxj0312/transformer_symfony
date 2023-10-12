<?php

declare(strict_types=1);

namespace App\Domain\Account\ValueObject;

use Stringable;

final class AccountId implements Stringable
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