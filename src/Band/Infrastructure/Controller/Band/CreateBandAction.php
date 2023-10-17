<?php

declare(strict_types=1);

namespace App\Band\Infrastructure\Controller\Band;

use App\Band\Application\Command\Band\CreateBandCommand;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Infrastructure\Exception\ApiException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

#[Route('/api/band/create', methods: ['POST'])]
final class CreateBandAction
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(
        #[MapRequestPayload] CreateBandCommand $createBandCommand
    ): JsonResponse
    {
        try {
            $this->commandBus->execute($createBandCommand);
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }

        return new JsonResponse(status:  201);
    }
}
