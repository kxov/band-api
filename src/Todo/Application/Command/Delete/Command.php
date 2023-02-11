<?php

declare(strict_types=1);

namespace App\Todo\Application\Command\Delete;

use App\Shared\Application\Command\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

class Command implements CommandInterface
{
    /**
     * @Assert\NotBlank()
     */
    public int $id;
}