<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Account\Contract\AccountRepositoryInterface;
use App\Entity\Account;
use Doctrine\ORM\EntityManagerInterface;
use App\Domain\Account\Model\Account;
use App\Domain\Account\Contract\AccountRepositoryInterface;
use App\Entity\Account;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineAccountRepository implements AccountRepositoryInterface
{
    /**
     * @var EntityManagerInterface 
     */
    private $entityManager;

    /**
     * @var EntityRepository<Account>
     */
    private $repository;

    /**
     * DoctrineAccountRepository constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Account::class);
    }

    /**
     * @inheritDoc
     */
    public function findByEmail(string $email): ?Account
    {
        return $this->repository->findOneBy(['email' => $email]);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?Account
    {
        return $this->repository->find($id);
    }

    
}

