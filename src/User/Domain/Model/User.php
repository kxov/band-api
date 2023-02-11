<?php

declare(strict_types=1);

namespace App\User\Domain\Model;

use App\Shared\Domain\Security\AuthUserInterface;
use App\Todo\Domain\Model\Todo;
use App\User\Domain\Service\UserPasswordHasherInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="`user`")
 */
class User implements AuthUserInterface, \JsonSerializable
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

    /**
     * @var Todo[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Todo\Domain\Model\Todo", mappedBy="user", orphanRemoval=true, cascade={"persist"})
     */
    private $todos;

    /**
     * @return ArrayCollection
     */

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
