<?php

declare(strict_types=1);

namespace App\TodoList\Domain\Repository;

use App\TodoList\Domain\Model\TodoList;

interface TodoListRepositoryInterface
{
    public function add(TodoList $todo): void;
    public function find(int $id): ?TodoList;
}