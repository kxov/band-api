<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Todo\Todo;
use App\Domain\Todo\TodoRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class TodoRepository implements TodoRepositoryInterface
{
    private $entityManager;

    public function __construct(private readonly ManagerRegistry $managerRegistry)
    {
        $this->entityManager = $managerRegistry->getManagerForClass(Todo::class);
    }

    public function add(Todo $todo): void
    {
        $this->entityManager->persist($todo);
        $this->entityManager->flush();
    }

    public function find(int $id): ?Todo
    {
        return $this->entityManager->find(Todo::class, $id);
    }
}