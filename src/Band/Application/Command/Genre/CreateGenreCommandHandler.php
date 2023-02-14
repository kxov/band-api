<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Genre;

use App\Band\Domain\Model\Genre;
use App\Band\Domain\Model\GenreRepositoryInterface;

class CreateGenreCommandHandler
{
    private GenreRepositoryInterface $genreRepository;

    public function __construct(
        GenreRepositoryInterface $genreRepository
    ) {
        $this->genreRepository = $genreRepository;
    }

    public function handle(CreateGenreCommand $command): void
    {
        $genre = new Genre($command->name);

        $this->genreRepository->add($genre);
    }
}