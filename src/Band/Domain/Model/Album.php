<?php

declare(strict_types=1);

namespace App\Band\Domain\Model;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Album
{
    private int $id;
    private string $name;
    private DateTimeImmutable $dateCreate;

    private Band $band;

    private Collection $songs;

    public function __construct(string $name, DateTimeImmutable $dateCreate, Band $band)
    {
        $this->name = $name;
        $this->dateCreate = $dateCreate;
        $this->band = $band;

        $this->songs = new ArrayCollection();
    }
}
