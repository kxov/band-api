<?php

declare(strict_types=1);

namespace App\Band\Infrastructure\Controller\Band;

use App\Band\Application\Command\Band\DeleteBandCommand;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Infrastructure\Exception\ApiException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/band/delete', methods: ['DELETE'])]
final class DeleteBandAction
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(#[MapRequestPayload] DeleteBandCommand $deleteBandCommand): JsonResponse
    {
        try {
            $this->commandBus->execute($deleteBandCommand);
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }

        return new JsonResponse(status:  204);
    }
}
