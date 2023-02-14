<?php

declare(strict_types=1);

namespace App\Band\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use DateTimeImmutable;

class Band
{
    private int $id;
    private string $name;
    private DateTimeImmutable $dateCreate;

    private Collection $genres;

    public function __construct(string $name, DateTimeImmutable $dateCreate)
    {
        $this->name = $name;
        $this->dateCreate = $dateCreate;
        $this->genres = new ArrayCollection();
    }
}
