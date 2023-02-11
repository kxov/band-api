<?php

declare(strict_types=1);

namespace App\Todo\Application\Command\Create;

use App\Shared\Application\Command\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class Command implements CommandInterface
{
    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    public string $name;
}
