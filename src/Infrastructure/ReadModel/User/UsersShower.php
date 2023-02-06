<?php

declare(strict_types=1);

namespace App\Infrastructure\ReadModel\User;

use Doctrine\DBAL\Connection;

class UsersShower
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function allList(): array
    {
        $stmt = $this->connection->createQueryBuilder()
            ->select(
                'u.id',
                'u.email',
                't.name',
                't.id as todoId'
            )
            ->from('public.user', 'u')
            ->leftJoin('u', 'public.todo', 't', 'u.id = t.user_id')
            ->orderBy('id')
            ->execute();

        return $stmt->fetchAll();
    }
}