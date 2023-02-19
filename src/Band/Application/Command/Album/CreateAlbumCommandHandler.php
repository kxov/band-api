<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Album;

use App\Band\Domain\Model\Album;
use App\Band\Domain\Model\AlbumRepositoryInterface;
use App\Band\Domain\Model\BandRepositoryInterface;

final class CreateAlbumCommandHandler
{
    private AlbumRepositoryInterface $albumRepository;
    private BandRepositoryInterface $bandRepository;

    public function __construct(
        AlbumRepositoryInterface $albumRepository,
        BandRepositoryInterface $bandRepository
    ) {
        $this->albumRepository = $albumRepository;
        $this->bandRepository = $bandRepository;
    }

    public function handle(CreateAlbumCommand $command): void
    {
        $band = $this->bandRepository->get($command->bandId);

        $album = new Album($command->name, $command->createdAt, $band);

        $this->albumRepository->create($album);
    }
}
