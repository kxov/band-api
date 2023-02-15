<?php

declare(strict_types=1);

namespace App\Band\Infrastructure\Domain\Repository;

use App\Band\Domain\Model\AlbumRepositoryInterface;
use App\Band\Domain\Model\Album;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineAlbumRepository implements AlbumRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function find(int $id): ?Album
    {
        return $this->em->find(Album::class, $id);
    }

    public function add(Album $band): void
    {
        $this->em->persist($band);
        $this->em->flush();
    }
}
