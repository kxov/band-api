<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Band\Album;

use App\Band\Domain\Model\BandRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;

final class ReleaseAlbumCommandHandler implements CommandHandlerInterface
{
    private BandRepositoryInterface $bandRepository;

    private EntityManagerInterface $entityManager;

    public function __construct(
        BandRepositoryInterface $bandRepository,
        EntityManagerInterface $entityManager,
    ) {
        $this->bandRepository = $bandRepository;
        $this->entityManager = $entityManager;
    }

    public function __invoke(ReleaseAlbumCommand $command): void
    {
        $band = $this->bandRepository->get($command->bandId);

        $band->releaseAlbum($command->name, $command->createdAt);

        $this->entityManager->flush();
    }
}
