<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Genre;

use App\Shared\Application\Command\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CreateGenreCommand implements CommandInterface
{
    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    public string $name;
}
