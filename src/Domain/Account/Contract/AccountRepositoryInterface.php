<?php

declare(strict_types=1);

namespace App\Domain\Account\Contract;

use App\Domain\Account\ValueObject\AccountId;

interface AccountRepositoryInterface
{
    /**
     * @throws AccountNotFound
     */
    public function findByEmail(EmailAddress $emailAddress): Account;

    /**
     * @throws AccountNotFound
     */
    public function findById(AccountId $id): Account;

    public function save(Account $account): void;
}