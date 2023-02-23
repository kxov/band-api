<?php

declare(strict_types=1);

namespace App\User\Application\Query\View;
class AuthView
{
    public int $id;
    public string $email;
    public string $hash;
    public string $role;
}