<?php

declare(strict_types=1);

namespace App\Tests\Builder\User;

use App\Tests\Unit\Util\RandomGenerateValue;
use App\User\Domain\Model\Role;
use App\User\Domain\Model\User;

class UserBuilder
{
    private int $id;

    private string $name;

    private string $email;
    private string $pass;

    private ?Role $role = null;

    public function __construct()
    {
        $this->id = RandomGenerateValue::getSmallInt();
        $this->name = RandomGenerateValue::getName();
        $this->email = RandomGenerateValue::getEmail();

        $this->pass = RandomGenerateValue::getSmallString();
    }

    public function withRole(Role $role): self
    {
        $clone = clone $this;
        $clone->role = $role;
        return $clone;
    }

    public function build(): User
    {
        $user = new User(
            $this->email
        );

        if ($this->role) {
            $user->changeRole($this->role);
        }

        return $user;
    }
}


