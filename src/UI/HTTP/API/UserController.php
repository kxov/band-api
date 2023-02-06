<?php

declare(strict_types=1);

namespace App\UI\HTTP\API;

use App\Infrastructure\Exception\ApiException;
use App\Infrastructure\ReadModel\User\UsersShower;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    private UsersShower $usersShower;

    public function __construct(UsersShower $usersShower)
    {
        $this->usersShower = $usersShower;
    }

    #[Route('/api/user/list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        try {
            $list = $this->usersShower->allList();
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }

        return new JsonResponse([
            $list
        ]);
    }
}