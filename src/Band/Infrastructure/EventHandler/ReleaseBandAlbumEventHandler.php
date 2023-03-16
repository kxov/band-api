<?php

declare(strict_types=1);

namespace App\Band\Infrastructure\EventHandler;

use App\Band\Domain\Event\ReleaseBandAlbumEvent;
use App\Shared\Domain\Event\EventHandlerInterface;
use Psr\Log\LoggerInterface;

class ReleaseBandAlbumEventHandler implements EventHandlerInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(ReleaseBandAlbumEvent $releaseBandAlbumEvent)
    {
        $this->logger->info(sprintf('New album was released, %d', $releaseBandAlbumEvent->albumName));
    }
}
