<?php

declare(strict_types=1);

namespace App\Infrastructure\Security;

use App\Domain\Security\AuthUserInterface;
use App\Domain\Security\UserFetcherInterface;
use Symfony\Component\Security\Core\Security;

class UserFetcher implements UserFetcherInterface
{
    public function __construct(private readonly Security $security)
    {
    }

    public function getAuthUser(): AuthUserInterface
    {
        /** @var AuthUserInterface $user */
        $user = $this->security->getUser();

        return $user;
    }
}
