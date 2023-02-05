<?php

declare(strict_types=1);

namespace App\UI\HTTP\API;

use App\Domain\Security\UserFetcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/api/users/me', methods: ['GET'])]
class GetMeAction
{
    public function __construct(private readonly UserFetcherInterface $userFetcher)
    {
    }
    public function __invoke()
    {
        $user = $this->userFetcher->getAuthUser();

        return new JsonResponse([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
        ]);
    }
}
