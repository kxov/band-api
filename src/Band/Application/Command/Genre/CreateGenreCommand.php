<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Genre;

use App\Shared\Application\Command\Command;
use Symfony\Component\Validator\Constraints as Assert;

class CreateGenreCommand extends Command
{
    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    public string $name;
}
