<?php

declare(strict_types=1);

namespace App\Band\Infrastructure\Domain\Repository;

use App\Band\Domain\Model\Band;
use App\Band\Domain\Model\BandRepositoryInterface;
use App\Shared\Infrastructure\Exception\ModelNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineBandRepository implements BandRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function find(int $id): ?Band
    {
        return $this->em->find(Band::class, $id);
    }

    public function create(Band $band): void
    {
        $this->em->persist($band);
        $this->em->flush();
    }

    public function get(int $id): Band
    {
        /** @var Band $todo */
        if (!$band = $this->em->find(Band::class, $id)) {
            throw new ModelNotFoundException('Band is not found.');
        }
        return $band;
    }
}