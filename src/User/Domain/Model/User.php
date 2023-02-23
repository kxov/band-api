<?php

declare(strict_types=1);

namespace App\User\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class User implements \JsonSerializable
{
    private int $id;
    private string $email;
    private ?string $password = null;

    private Role $role;

    private Collection $todos;

    public function __construct(string $email)
    {
        $this->email = $email;
        $this->todos = new ArrayCollection();
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

    public function getRoles(): array
    {
        return [
           $this->role->getName()
        ];
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function changeRole(Role $role): void
    {
        if ($this->role->isEqual($role)) {
            throw new \DomainException('Role is already same.');
        }
        $this->role = $role;
    }

    public function getTodos(): ArrayCollection
    {
        return $this->todos;
    }

    public function jsonSerialize(): array
    {
        $user = [
            'id' => $this->id,
            'name' => $this->email,
            'todos' => []
        ];

        foreach($this->todos as $todo)
        {
            $user['todos'][] = $todo->jsonSerialize();
        }

        return $user;
    }
}
