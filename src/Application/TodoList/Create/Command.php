<?php

declare(strict_types=1);

namespace App\Application\TodoList\Create;

use App\Infrastructure\Request\RequestApiInterface;
use Symfony\Component\Validator\Constraints as Assert;

class Command implements RequestApiInterface
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