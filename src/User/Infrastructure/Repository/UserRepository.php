<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Repository;

use App\User\Domain\Model\User;
use App\User\Domain\Model\UserRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository implements UserRepositoryInterface
{
    private $entityManager;
    private $repository;

    public function __construct(private readonly ManagerRegistry $managerRegistry)
    {
        $this->entityManager = $managerRegistry->getManagerForClass(User::class);
        $this->repository = $managerRegistry->getRepository(User::class);
    }

    public function add(User $order): void
    {
        $this->entityManager->persist($order);
        $this->entityManager->flush();
    }

    public function findById(int $id): User
    {
        return $this->entityManager->find(User::class, $id);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->repository->findOneBy(['email' => $email]);
    }
}
