<?php

declare(strict_types=1);

namespace App\UI\HTTP\API;

use App\Application\Todo\Create;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TodoController
{
    private Create\Handler $createHandler;

    public function __construct(Create\Handler $createHandler)
    {
        $this->createHandler = $createHandler;
    }

    #[Route('/api/todo/create', methods: ['POST'])]
    public function create(Create\Command $command): JsonResponse
    {
        $todo = $this->createHandler->handle($command);

        return new JsonResponse($todo, 201);
    }
}
