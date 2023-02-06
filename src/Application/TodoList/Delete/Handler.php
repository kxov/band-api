<?php

declare(strict_types=1);

namespace App\Application\TodoList\Delete;

use App\Domain\TodoList\TodoListRepositoryInterface;

class Handler
{
    private TodoListRepositoryInterface $todoListRepository;
    public function __construct(TodoListRepositoryInterface $todoListRepository)
    {
        $this->todoListRepository = $todoListRepository;
    }

    public function handle(Command $command): void
    {
        $todo = $this->todoListRepository->get($command->id);

        $this->todoListRepository->remove($todo);
    }
}