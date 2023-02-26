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

    private Collection $albums;

    public function __construct(string $name, ?DateTimeImmutable $dateCreate = null)
    {
        $this->name = $name;
        $this->dateCreate = $dateCreate ?? new DateTimeImmutable();
        $this->genres = new ArrayCollection();
        $this->albums = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

}

