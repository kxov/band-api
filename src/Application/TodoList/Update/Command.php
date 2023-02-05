<?php

declare(strict_types=1);

namespace App\Application\TodoList\Update;

use App\Infrastructure\Request\RequestApiInterface;
use Symfony\Component\Validator\Constraints as Assert;

class Command implements RequestApiInterface
{
    /**
     * @Assert\NotBlank()
     */
    public int $id;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $name;

    /**
     * @var boolean
     * @Assert\NotBlank()
     */
    public bool $done;
}