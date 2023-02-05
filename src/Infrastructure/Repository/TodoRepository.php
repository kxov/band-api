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

    public function add(Todo $product): void
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    public function find(int $id): ?Todo
    {
        return $this->entityManager->find(Todo::class, $id);
    }
}