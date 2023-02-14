<?php

declare(strict_types=1);

namespace App\Band\Infrastructure\Controller;

use App\Band\Application\Command\Band\CreateBandCommand;
use App\Band\Application\Command\Band\CreateBandCommandHandler;
use App\Shared\Infrastructure\Exception\ApiException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/band/create', methods: ['POST'])]
final class CreateBandAction
{
    private CreateBandCommandHandler $createBandCommandHandler;

    public function __construct(CreateBandCommandHandler $createBandCommandHandler)
    {
        $this->createBandCommandHandler = $createBandCommandHandler;
    }

    public function __invoke(CreateBandCommand $createBandCommand): JsonResponse
    {
        try {
            $this->createBandCommandHandler->handle($createBandCommand);
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }

        return new JsonResponse(status:  201);
    }
}
