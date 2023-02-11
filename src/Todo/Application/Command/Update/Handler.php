<?php

declare(strict_types=1);

namespace App\Todo\Application\Command\Update;

use App\Todo\Domain\Repository\TodoRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class Handler
{
    private TodoRepositoryInterface $todoRepository;

    private EntityManagerInterface $entityManager;

    public function __construct(
        TodoRepositoryInterface $todoRepository,
        EntityManagerInterface $entityManager
    )
    {
        $this->todoRepository = $todoRepository;
        $this->entityManager = $entityManager;
    }

    public function handle(Command $command): void
    {
        $todo = $this->todoRepository->get($command->id);

        $todo->edit($command->name);

        $this->entityManager->flush();
    }
}
