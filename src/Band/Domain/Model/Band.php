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

    public function releaseAlbum(string $albumName, ?DateTimeImmutable $dateCreate = null): void
    {
        foreach ($this->albums as $album) {
            if ($album->isNameEqual($albumName)) {
                throw new \DomainException('Album already exists.');
            }
        }
        $this->albums->add(new Album($this, $albumName, $dateCreate));
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDateCreate(): DateTimeImmutable
    {
        return $this->dateCreate;
    }

    public function update(string $name, DateTimeImmutable $dateCreate): void
    {
        $this->name = $name;
        $this->dateCreate = $dateCreate;
    }
}

