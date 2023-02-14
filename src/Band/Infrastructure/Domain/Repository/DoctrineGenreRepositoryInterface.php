<?php

declare(strict_types=1);

namespace App\Band\Infrastructure\Domain\Repository;

use App\Band\Domain\Model\Genre;
use App\Band\Domain\Model\GenreRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineGenreRepositoryInterface implements GenreRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function find(int $id): ?Genre
    {
        return $this->em->find(Genre::class, $id);
    }

    public function add(Genre $band): void
    {
        $this->em->persist($band);
        $this->em->flush();
    }
}
