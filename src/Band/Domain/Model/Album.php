<?php

declare(strict_types=1);

namespace App\Band\Domain\Model;

use DateTimeImmutable;

class Album
{
    private int $id;
    private string $name;
    private DateTimeImmutable $dateCreate;

    private Band $band;

    public function __construct(string $name, DateTimeImmutable $dateCreate, Band $band)
    {
        $this->name = $name;
        $this->dateCreate = $dateCreate;
        $this->band = $band;
    }
}
