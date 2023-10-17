<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Band\Album;

use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;

class ReleaseAlbumCommand
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $albumName;

    public DateTimeImmutable $createdAt;

    public ?int $bandId = null;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }
}

