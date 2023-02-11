<?php

declare(strict_types=1);

namespace App\Todo\Domain\Model;

use App\TodoList\Domain\Model\TodoList;
use App\User\Domain\Model\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="`todo`")
 */
class Todo implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     *
     * @var string
     */
    private string $name;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\User\Domain\Model\User", inversedBy="todos")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private User $user;

    /**
     * @var TodoList[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="App\TodoList\Domain\Model\TodoList", mappedBy="todo", orphanRemoval=true, cascade={"persist"})
     */
    private $todoList;

    public function __construct(User $user, string $name)
    {
        $this->user = $user;
        $this->name = $name;
        $this->todoList = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return ArrayCollection|TodoList[]
     */
    public function getTodoList(): ArrayCollection|array
    {
        return $this->todoList;
    }

    public function edit(string $name): void
    {
        $this->name = $name;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}

