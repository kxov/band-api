<?php

declare(strict_types=1);

namespace App\Domain\TodoList;

interface TodoListRepositoryInterface
{
    public function add(TodoList $todo): void;
    public function find(int $id): ?TodoList;
}