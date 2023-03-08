<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Band\Album;

use App\Shared\Application\Command\Command;
use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;

class ReleaseAlbumCommand extends Command
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $name;

    public DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }
}

