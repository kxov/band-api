<?php

declare(strict_types=1);

namespace App\Band\Infrastructure\Domain\Repository;

use App\Band\Domain\Model\Band;
use App\Band\Domain\Model\BandRepository;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineBandRepository implements BandRepository
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
}