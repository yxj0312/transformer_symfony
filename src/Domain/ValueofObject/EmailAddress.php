<?php

namespace App\Domain\Account\Contract;

use Stringable;
use Webmozart\Assert\Assert;

final class EmailAddress implements Stringable
{
    private $email;

    private function __construct(string $email)
    {
        // Use Webmozart\Assert\Assert to validate the email address
        // if wrong, the library will throw an exception, like this:
        // InvalidArgumentException: Invalid email address "foo"
        Assert::email($email);
        
        $this->email = $email;
    }

    public static function create(string $email): self
    {
        return new self($email);
    }

    public function __toString(): string
    {
        return $this->email;
    }

    public function equals(string $email): bool
    {
        return $this->email === $email;
    }
}