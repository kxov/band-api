<?php

declare(strict_types=1);

namespace App\TodoList\Infrastructure\Controller;

use App\Todo\Application\Command\Create;
use App\Todo\Application\Command\Delete;
use App\Todo\Application\Command\Update;
use App\Shared\Infrastructure\Exception\ApiException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TodoListController
{
    private Create\Handler $createHandler;
    private Delete\Handler $deleteHandler;
    private Update\Handler $updateHandler;

    public function __construct(
        Create\Handler $createHandler,
        Delete\Handler $deleteHandler,
        Update\Handler $updateHandler,
    )
    {
        $this->createHandler = $createHandler;
        $this->deleteHandler = $deleteHandler;
        $this->updateHandler = $updateHandler;
    }

    #[Route('/api/todo-list/create', methods: ['POST'])]
    public function create(Create\Command $command): JsonResponse
    {
        try {
            $this->createHandler->handle($command);
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }

        return new JsonResponse(status:  201);
    }

    #[Route('/api/todo-list/delete', methods: ['POST'])]
    public function delete(Delete\Command $command): JsonResponse
    {
        try {
            $this->deleteHandler->handle($command);
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }

        return new JsonResponse(status:  204);
    }

    #[Route('/api/todo-list/update', methods: ['POST'])]
    public function update(Update\Command $command): JsonResponse
    {
        try {
            $this->updateHandler->handle($command);
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }

        return new JsonResponse(status:  200);
    }
}