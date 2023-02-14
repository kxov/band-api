<?php

declare(strict_types=1);

namespace App\Band\Domain\Model;
interface GenreRepository
{
    public function add(Genre $genre): void;
}