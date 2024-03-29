<?php

declare(strict_types=1);

namespace App\Band\Infrastructure\Controller\Genre;

use App\Band\Application\Command\Genre\CreateGenreCommand;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Infrastructure\Exception\ApiException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/genre/create', methods: ['POST'])]
final class CreateGenreAction
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(CreateGenreCommand $createGenreCommand): JsonResponse
    {
        try {
            $this->commandBus->execute($createGenreCommand);
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }

        return new JsonResponse(status:  201);
    }
}
