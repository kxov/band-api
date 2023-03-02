<?php

declare(strict_types=1);

namespace App\Band\Domain\Model;

interface AlbumRepositoryInterface
{
    public function create(Album $album): void;
}