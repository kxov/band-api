<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Security\Service\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }
    public function create(string $email, string $password): User
    {
        $user = new User($email);
        $user->setPassword($password, $this->passwordHasher);

        return $user;
    }
}