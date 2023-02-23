<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Security;

use App\User\Application\Query\View\AuthView;
use App\User\Application\ReadModel\User\UsersShower;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    private UsersShower $users;

    public function __construct(UsersShower $users)
    {
        $this->users = $users;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->loadUser($identifier);
        return self::identityByUser($user);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof UserIdentity) {
            throw new UnsupportedUserException('Invalid user class ' . \get_class($user));
        }

        $user = $this->loadUser($user->getEmail());
        return self::identityByUser($user);
    }

    public function supportsClass($class): bool
    {
        return $class instanceof UserIdentity;
    }

    private function loadUser(string $email): array
    {
        if ($user = $this->users->findForAuthByEmail($email)) {
            return $user;
        }

        throw new UserNotFoundException('');
    }

    private static function identityByUser(array $user): UserIdentity
    {
        return new UserIdentity(
            $user['id'],
            $user['email'],
            $user['password'] ?: '',
            $user['role'] ?: 'ROLE_USER',
        );
    }
}