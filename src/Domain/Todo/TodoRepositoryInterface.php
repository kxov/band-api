<?php

declare(strict_types=1);

namespace App\Domain\Todo;
use App\Domain\TodoList\TodoList;

interface TodoRepositoryInterface
{
    public function add(Todo $todo): void;
    public function find(int $id): ?Todo;
}
