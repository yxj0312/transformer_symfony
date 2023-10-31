<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Account\Contract\AccountRepositoryInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineAccountRepository implements AccountRepositoryInterface
{
    /**
     * @var EntityRepository<Account>
     */
    private $repository;

    /**
     * @var EntityManagerInterface 
     */
    private $entityManager;

    /**
     * UserRepository constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Account::class);
        $this->entityManager = $entityManager;
    }
}