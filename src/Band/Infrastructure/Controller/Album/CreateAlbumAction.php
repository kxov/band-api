<?php

declare(strict_types=1);

namespace App\Band\Infrastructure\Controller\Album;

use App\Band\Application\Command\Album\CreateAlbumCommand;
use App\Band\Application\Command\Album\CreateAlbumCommandHandler;
use App\Shared\Infrastructure\Exception\ApiException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/band/{bandId}/album/create', requirements: ['bandId' => '\d+'], methods: ['POST'])]
final class CreateAlbumAction
{
    private CreateAlbumCommandHandler $createAlbumCommandHandler;

    public function __construct(CreateAlbumCommandHandler $createAlbumCommandHandler)
    {
        $this->createAlbumCommandHandler = $createAlbumCommandHandler;
    }

    public function __invoke(int $bandId, CreateAlbumCommand $createBandCommand): JsonResponse
    {
        try {
            $this->createAlbumCommandHandler->handle($createBandCommand);
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }

        return new JsonResponse(status:  201);
    }
}
