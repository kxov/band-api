<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Security;

use Symfony\Component\PasswordHasher\Hasher\CheckPasswordLengthTrait;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class PasswordHasher implements PasswordHasherInterface
{
    use CheckPasswordLengthTrait;

    private string $algorithm = \PASSWORD_ARGON2I;

    public function hash(string $plainPassword): string
    {
        $hashedPassword = password_hash($plainPassword, $this->algorithm);
        if ($hashedPassword === false) {
            throw new \RuntimeException('Unable to generate hash.');
        }
        return $hashedPassword;
    }

    public function verify(string $hashedPassword, string $plainPassword): bool
    {
        if ('' === $plainPassword || $this->isPasswordTooLong($plainPassword)) {
            return false;
        }

        return password_verify($plainPassword, $hashedPassword);
    }

    public function needsRehash(string $hashedPassword): bool
    {
        // Check if a password hash would benefit from rehashing
        return password_needs_rehash($hashedPassword, $this->algorithm);
    }
}
