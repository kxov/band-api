<?php

declare(strict_types=1);

namespace App\Band\Domain\Model;

class Song
{
    private int $id;
    private string $name;

    private \DateTimeImmutable $time;

    private Album $album;

    public function __construct(string $name, \DateTimeImmutable $time, Album $album)
    {
        $this->name = $name;
        $this->time = $time;
        $this->album = $album;
    }
}
