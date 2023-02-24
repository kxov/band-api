<?php

declare(strict_types=1);

namespace App\User\Application\Query\View;

class AuthView
{
    public int $id;
    public string $email;
    public string $hash;
    public string $role;

    public static function fromArray(array $data): AuthView
    {
        $authView = new self();

        $authView->id = $data['id'];
        $authView->email = $data['email'];
        $authView->hash = $data['password'];
        $authView->role = $data['role'];

        return $authView;
    }
}