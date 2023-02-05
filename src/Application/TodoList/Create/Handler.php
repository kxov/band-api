<?php

declare(strict_types=1);

namespace App\Application\TodoList\Create;

use App\Domain\Todo\TodoRepositoryInterface;
use App\Domain\TodoList\TodoList;
use App\Domain\TodoList\TodoListRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class Handler
{
    private TodoListRepositoryInterface $todoListRepository;

    private TodoRepositoryInterface $todoRepository;

    private EntityManagerInterface $entityManager;

    public function __construct(
        TodoListRepositoryInterface $todoListRepository,
        TodoRepositoryInterface $todoRepository,
        EntityManagerInterface $entityManager
    )
    {
        $this->todoListRepository = $todoListRepository;
        $this->todoRepository = $todoRepository;
        $this->entityManager = $entityManager;
    }

    public function handle(Command $command): void
    {
        $todo = $this->todoRepository->get($command->todoId);

        $todoList = new TodoList($command->name, $todo);

        $this->todoListRepository->add($todoList);

        $this->entityManager->flush();
    }
}
