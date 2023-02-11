<?php

declare(strict_types=1);

namespace App\TodoList\Application\Command\Create;

use App\Todo\Domain\Repository\TodoRepositoryInterface;
use App\TodoList\Domain\Model\TodoList;
use App\TodoList\Domain\Repository\TodoListRepositoryInterface;
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
