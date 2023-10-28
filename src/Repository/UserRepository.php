<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Account\Contract\EmailAddress;
use App\Domain\User\Contact\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use App\Entity\User;

final class UserRepository implements UserRepositoryInterface
{
    /**
     * @var EntityRepository<User>
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
        $this->repository = $entityManager->getRepository(User::class);
        $this->entityManager = $entityManager;
    }

    /**
     * @throws \Exception
     *
     * @param EmailAddress $emailAddress
     * @return User
     */    
    public function findByEmail(EmailAddress $emailAddress): User
    {
        $user = $this->repository->findOneBy(['email' => $emailAddress->__toString()]);

        if (!$user instanceof User) {
            throw new \Exception('User not found');
        }
        return $user;
    }

    // public function findById(UserId $id): User
    // {
    //     return $this->repository->find($id->toInt());
    // }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
