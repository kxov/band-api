<?php

declare(strict_types=1);

namespace App\TodoList\Application\Command\Update;

use App\TodoList\Domain\Repository\TodoListRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class Handler
{
    private TodoListRepositoryInterface $todoListRepository;

    private EntityManagerInterface $entityManager;

    public function __construct(
        TodoListRepositoryInterface $todoListRepository,
        EntityManagerInterface $entityManager
    )
    {
        $this->todoListRepository = $todoListRepository;
        $this->entityManager = $entityManager;
    }

    public function handle(Command $command): void
    {
        $todoList = $this->todoListRepository->get($command->id);

        $todoList->edit($command->name, $command->done);

        $this->entityManager->flush();
    }
}