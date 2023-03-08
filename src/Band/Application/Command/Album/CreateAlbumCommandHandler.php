<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Album;

use App\Band\Domain\Model\AlbumRepositoryInterface;
use App\Band\Domain\Model\BandRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final class CreateAlbumCommandHandler
{
    private BandRepositoryInterface $bandRepository;

    private EntityManagerInterface $entityManager;

    public function __construct(
        AlbumRepositoryInterface $albumRepository,
        BandRepositoryInterface $bandRepository,
        EntityManagerInterface $entityManager,
    ) {
        $this->albumRepository = $albumRepository;
        $this->bandRepository = $bandRepository;
        $this->entityManager = $entityManager;
    }

    public function handle(CreateAlbumCommand $command): void
    {
        $band = $this->bandRepository->get($command->bandId);

        $band->releaseAlbum($command->name, $command->createdAt);

        $this->entityManager->flush();
    }
}
