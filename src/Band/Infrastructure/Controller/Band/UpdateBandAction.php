<?php

declare(strict_types=1);

namespace App\Band\Infrastructure\Controller\Band;

use App\Band\Application\Command\Band\UpdateBandCommand;
use App\Band\Application\Command\Band\UpdateBandCommandHandler;
use App\Shared\Infrastructure\Exception\ApiException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/band/update', methods: ['POST'])]
class UpdateBandAction
{
    private UpdateBandCommandHandler $updateBandCommandHandler;

    public function __construct(UpdateBandCommandHandler $updateBandCommandHandler)
    {
        $this->updateBandCommandHandler = $updateBandCommandHandler;
    }

    public function __invoke(UpdateBandCommand $updateBandCommand): JsonResponse
    {
        try {
            $this->updateBandCommandHandler->handle($updateBandCommand);
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }

        return new JsonResponse(status:  200);
    }
}
