<?php

declare(strict_types=1);

namespace App\Band\Infrastructure\Controller\Band;

use App\Band\Application\Command\Band\DeleteBandCommand;
use App\Band\Application\Command\Band\DeleteBandCommandHandler;
use App\Shared\Infrastructure\Exception\ApiException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/band/delete', methods: ['DELETE'])]
final class DeleteBandAction
{
    private DeleteBandCommandHandler $deleteBandCommandHandler;

    public function __construct(DeleteBandCommandHandler $deleteBandCommandHandler)
    {
        $this->deleteBandCommandHandler = $deleteBandCommandHandler;
    }

    public function __invoke(DeleteBandCommand $deleteBandCommand): JsonResponse
    {
        try {
            $this->deleteBandCommandHandler->handle($deleteBandCommand);
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }

        return new JsonResponse(status:  204);
    }
}
