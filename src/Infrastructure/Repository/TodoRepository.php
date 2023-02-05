<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\ModelNotFoundException;
use App\Domain\Todo\Todo;
use App\Domain\Todo\TodoRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class TodoRepository implements TodoRepositoryInterface
{
    private $entityManager;

    private $repository;

    public function __construct(private readonly ManagerRegistry $managerRegistry)
    {
        $this->entityManager = $managerRegistry->getManagerForClass(Todo::class);
        $this->repository = $managerRegistry->getRepository(Todo::class);
    }

    public function add(Todo $todo): void
    {
        $this->entityManager->persist($todo);
        $this->entityManager->flush();
    }

    public function remove(Todo $todo): void
    {
        $this->entityManager->remove($todo);
        $this->entityManager->flush();
    }

    public function find(int $id): ?Todo
    {
        return $this->entityManager->find(Todo::class, $id);
    }

    public function get(int $id): Todo
    {
        /** @var Todo $todo */
        if (!$todo = $this->repository->find($id)) {
            throw new ModelNotFoundException('Todo is not found.');
        }
        return $todo;
    }
}