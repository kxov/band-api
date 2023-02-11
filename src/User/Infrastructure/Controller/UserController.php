<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Controller;

use App\Shared\Infrastructure\Exception\ApiException;
use App\User\Application\ReadModel\User\UsersShower;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    private UsersShower $usersShower;

    public function __construct(
        UsersShower $usersShower
    )
    {
        $this->usersShower = $usersShower;
    }

    #[Route('/api/user/list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        try {
            $list = $this->usersShower->getAllList();
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }

        return new JsonResponse([
            $list
        ]);
    }
}
