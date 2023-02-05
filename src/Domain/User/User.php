<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Security\Service\UserPasswordHasherInterface;
use App\Domain\Security\AuthUserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="`user`")
 */
class User implements AuthUserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     *
     * @var string
     */
    private string $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var ?string
     */
    private ?string $password = null;

    public function __construct(string $email)
    {
        $this->email = $email;
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
}
