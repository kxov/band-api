<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Band;

use App\Shared\Application\Command\CommandInterface;
use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;

class DeleteBandCommand implements CommandInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("int")
     */
    public int $id;
}