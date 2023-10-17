<?php

declare(strict_types=1);

namespace App\Band\Infrastructure\Controller\Band;

use App\Band\Application\Command\Band\Album\ReleaseAlbumCommand;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Infrastructure\Exception\ApiException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/band/{bandId}/album/release', requirements: ['bandId' => '\d+'], methods: ['POST'])]
final class ReleaseAlbumAction
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(int $bandId, #[MapRequestPayload] ReleaseAlbumCommand $releaseAlbumCommand): JsonResponse
    {
        $releaseAlbumCommand->bandId = $bandId;

        try {
            $this->commandBus->execute($releaseAlbumCommand);
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }

        return new JsonResponse(status:  201);
    }
}
