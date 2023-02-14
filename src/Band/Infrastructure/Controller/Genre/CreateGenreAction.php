<?php

declare(strict_types=1);

namespace App\Band\Infrastructure\Controller\Genre;

use App\Band\Application\Command\Genre\CreateGenreCommand;
use App\Band\Application\Command\Genre\CreateGenreCommandHandler;
use App\Shared\Infrastructure\Exception\ApiException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/genre/create', methods: ['POST'])]
final class CreateGenreAction
{
    private CreateGenreCommandHandler $createGenreCommandHandler;

    public function __construct(CreateGenreCommandHandler $createGenreCommandHandler)
    {
        $this->createGenreCommandHandler = $createGenreCommandHandler;
    }

    public function __invoke(CreateGenreCommand $createGenreCommand): JsonResponse
    {
        try {
            $this->createGenreCommandHandler->handle($createGenreCommand);
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }

        return new JsonResponse(status:  201);
    }
}
