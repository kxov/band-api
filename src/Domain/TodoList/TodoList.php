<?php

declare(strict_types=1);

namespace App\Domain\TodoList;

use App\Domain\Todo\Todo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="`todo_list`")
 */
class TodoList
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
     * @ORM\Column(type="boolean", nullable=false)
     *
     * @var bool
     */
    private bool $done;

    /**
     * @var Todo
     * @ORM\ManyToOne(targetEntity="App\Domain\Todo\Todo", inversedBy="todoList")
     * @ORM\JoinColumn(name="todo_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private Todo $todo;

    public function __construct(string $name, Todo $todo)
    {
        $this->name = $name;
        $this->todo = $todo;
        $this->done = false;
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
     * @return bool
     */
    public function isDone(): bool
    {
        return $this->done;
    }

    /**
     * @return Todo
     */
    public function getTodo(): Todo
    {
        return $this->todo;
    }

    public function edit(string $name, bool $done): void
    {
        $this->name = $name;
        $this->done = $done;
    }
}