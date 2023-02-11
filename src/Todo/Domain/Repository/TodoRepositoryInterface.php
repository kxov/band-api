<?php

declare(strict_types=1);

namespace App\Todo\Domain\Repository;

use App\Todo\Domain\Model\Todo;

interface TodoRepositoryInterface
{
    public function add(Todo $todo): void;
    public function find(int $id): ?Todo;
}
