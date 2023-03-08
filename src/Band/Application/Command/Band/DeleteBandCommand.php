<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Band;

use App\Shared\Application\Command\Command;
use Symfony\Component\Validator\Constraints as Assert;

class DeleteBandCommand extends Command
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("int")
     */
    public int $id;
}