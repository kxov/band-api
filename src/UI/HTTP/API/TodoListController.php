<?php

declare(strict_types=1);

namespace App\UI\HTTP\API;

use App\Application\TodoList\Create;
use App\Application\TodoList\Delete;
use App\Application\TodoList\Update;
use App\Infrastructure\Exception\ApiException;
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