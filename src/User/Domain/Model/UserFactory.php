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
        $user = new User($email);

        $hashedPass = $this->passwordHasher->hash($password);
        //$password = $this->passwordHasher->hash($user, $password);

        $user->setPassword($hashedPass);

        return $user;
    }
}