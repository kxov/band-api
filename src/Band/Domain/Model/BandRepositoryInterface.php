<?php

declare(strict_types=1);

namespace App\Band\Domain\Model;

interface BandRepositoryInterface
{
    public function create(Band $band): void;
    public function find(int $id): ?Band;
}