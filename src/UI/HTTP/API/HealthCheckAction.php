<?php

declare(strict_types=1);

namespace App\UI\HTTP\API;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/health', name: 'health')]

class HealthCheckAction
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['status' => 'ok']);
    }
}
