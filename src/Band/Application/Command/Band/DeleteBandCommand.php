<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Band;

use Symfony\Component\Validator\Constraints as Assert;

class DeleteBandCommand
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("int")
     */
    public int $id;
}