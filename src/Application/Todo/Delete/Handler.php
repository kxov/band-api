<?php

declare(strict_types=1);

namespace App\Application\Todo\Delete;
use App\Domain\Todo\TodoRepositoryInterface;

class Handler
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function handle(Command $command): void
    {
        $todo = $this->todoRepository->get($command->id);

        $this->todoRepository->remove($todo);
    }
}
