<?php

declare(strict_types=1);

namespace App\TodoList\Infrastructure\Repository;

use App\TodoList\Domain\Model\TodoList;
use App\TodoList\Domain\Repository\TodoListRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;
use Exception\ModelNotFoundException;

class TodoListRepository implements TodoListRepositoryInterface
{
    private $entityManager;

    private $repository;

    public function __construct(private readonly ManagerRegistry $managerRegistry)
    {
        $this->entityManager = $managerRegistry->getManagerForClass(TodoList::class);
        $this->repository = $managerRegistry->getRepository(TodoList::class);
    }

    public function add(TodoList $todo): void
    {
        $this->entityManager->persist($todo);
        $this->entityManager->flush();
    }

    public function remove(TodoList $todo): void
    {
        $this->entityManager->remove($todo);
        $this->entityManager->flush();
    }

    public function find(int $id): ?TodoList
    {
        return $this->entityManager->find(TodoList::class, $id);
    }

    public function get(int $id): TodoList
    {
        /** @var TodoList $todoList */
        if (!$todoList = $this->repository->find($id)) {
            throw new ModelNotFoundException('TodoList is not found.');
        }
        return $todoList;
    }
}