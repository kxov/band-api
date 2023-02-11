<?php

declare(strict_types=1);

namespace App\TodoList\Application\Command\Create;

use App\Shared\Application\Command\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

class Command implements CommandInterface
{
    /**
     * @Assert\NotBlank()
     */
    public int $todoId;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $name;
}