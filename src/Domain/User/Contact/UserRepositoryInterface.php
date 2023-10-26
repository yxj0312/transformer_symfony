<?php

declare(strict_types=1);

namespace App\Domain\User\Contact;

use App\Domain\User\ValueObject\UserId;
use App\Entity\User;

interface UserRepositoryInterface
{
    public function findByEmail(EmailAddress $emailAddress): User;

    public function findById(UserId $id): User;

    public function save(User $user): void;
}