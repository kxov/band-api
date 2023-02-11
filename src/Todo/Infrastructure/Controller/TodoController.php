<?php

declare(strict_types=1);

namespace App\Todo\Infrastructure\Controller;

use App\Todo\Application\Command\Create;
use App\Todo\Application\Command\Delete;
use App\Todo\Application\Command\Update;

use App\Shared\Infrastructure\Exception\ApiException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TodoController
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

    #[Route('/api/todo/create', methods: ['POST'])]
    public function create(Create\Command $command): JsonResponse
    {
        $todo = $this->createHandler->handle($command);

        return new JsonResponse($todo, 201);
    }

    #[Route('/api/todo/delete', methods: ['POST'])]
    public function delete(Delete\Command $command): JsonResponse
    {
        try {
            $this->deleteHandler->handle($command);
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }

        return new JsonResponse(status: 204);
    }

    #[Route('/api/todo/update', methods: ['POST'])]
    public function update(Update\Command $command): JsonResponse
    {
        try {
            $this->updateHandler->handle($command);
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }

        return new JsonResponse(status: 200);
    }
}
