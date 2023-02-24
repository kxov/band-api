<?php

declare(strict_types=1);

namespace App\User\Domain\Model;

use App\Shared\Infrastructure\Security\PasswordHasher;

class UserFactory
{
    public function __construct(private readonly PasswordHasher $passwordHasher)
    {
    }

    public function create(string $email, string $password): User
    {
        return new User($email, $this->passwordHasher->hash($password));
    }
}
