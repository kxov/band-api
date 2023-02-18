<?php

declare(strict_types=1);

namespace App\User\Domain\Model;

use App\Shared\Domain\Security\AuthUserInterface;
use App\User\Domain\Service\UserPasswordHasherInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class User implements AuthUserInterface, \JsonSerializable
{
    private int $id;
    private string $email;
    private ?string $password = null;
    private Collection $todos;

    public function __construct(string $email)
    {
        $this->email = $email;
        $this->todos = new ArrayCollection();
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
            'ROLE_USER',
        ];
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function setPassword(?string $password, UserPasswordHasherInterface $passwordHasher): void
    {
        if (is_null($password)) {
            $this->password = null;
        }

        $this->password = $passwordHasher->hash($this, $password);
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
