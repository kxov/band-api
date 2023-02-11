<?php

declare(strict_types=1);

namespace App\User\Domain\Service;

use App\User\Domain\Model\User;

interface UserPasswordHasherInterface
{
    public function hash(User $user, string $password): string;
}