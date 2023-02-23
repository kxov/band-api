<?php

declare(strict_types=1);

namespace App\Shared\Domain\Security;

use App\Shared\Infrastructure\Security\UserIdentity;

interface UserFetcherInterface
{
    public function getAuthUser(): UserIdentity;
}