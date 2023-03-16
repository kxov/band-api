<?php

declare(strict_types=1);

namespace App\Band\Domain\Event;

use App\Shared\Domain\Event\EventInterface;

final class ReleaseBandAlbumEvent implements EventInterface
{
    public function __construct(public readonly string $albumName)
    {
    }
}
