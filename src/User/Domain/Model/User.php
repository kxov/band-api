<?php

declare(strict_types=1);

namespace App\User\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class User //implements \JsonSerializable
{
    private int $id;
    private string $email;
    private ?string $password = null;

    private Role $role;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->role = Role::user();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function changeRole(Role $role): void
    {
        if ($this->role->isEqual($role)) {
            throw new \DomainException('Role is already same.');
        }
        $this->role = $role;
    }

//    public function jsonSerialize(): array
//    {
//        $user = [
//            'id' => $this->id,
//            'name' => $this->email,
//            'todos' => []
//        ];
//
//        foreach($this->todos as $todo)
//        {
//            $user['todos'][] = $todo->jsonSerialize();
//        }
//
//        return $user;
//    }
}
