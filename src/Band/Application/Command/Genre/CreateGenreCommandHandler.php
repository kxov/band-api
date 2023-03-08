<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Genre;

use App\Band\Domain\Model\Genre;
use App\Band\Domain\Model\GenreRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateGenreCommandHandler implements CommandHandlerInterface
{
    private GenreRepositoryInterface $genreRepository;

    public function __construct(
        GenreRepositoryInterface $genreRepository
    ) {
        $this->genreRepository = $genreRepository;
    }

    public function __invoke(CreateGenreCommand $command): void
    {
        $genre = new Genre($command->name);

        $this->genreRepository->add($genre);
    }
}