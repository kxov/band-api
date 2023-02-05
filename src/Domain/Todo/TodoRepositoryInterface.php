<?php

declare(strict_types=1);

namespace App\Domain\Todo;
interface TodoRepositoryInterface
{
    public function add(Todo $product): void;
    public function find(int $id): ?Todo;
}
