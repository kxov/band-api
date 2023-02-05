<?php

declare(strict_types=1);

namespace App\Domain\Security\Service;

use App\Domain\User\User;

interface UserPasswordHasherInterface
{
    public function hash(User $user, string $password): string;
}