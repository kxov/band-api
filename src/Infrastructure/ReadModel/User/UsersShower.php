<?php

declare(strict_types=1);

namespace App\Infrastructure\ReadModel\User;

use App\Domain\User\User;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class UsersShower
{
    private Connection $connection;

    private EntityRepository $repository;

    public function __construct(Connection $connection, EntityManagerInterface $entityManager)
    {
        $this->connection = $connection;
        $this->repository = $entityManager->getRepository(User::class);
    }

//    public function allList(): array
//    {
//        $stmt = $this->connection->createQueryBuilder()
//            ->select(
//                'u.id',
//                'u.email',
//                't.name',
//                't.id as todoId'
//            )
//            ->from('user', 'u')
//            ->join('u', 'todo', 't', 'u.id = t.user_id')
//            ->orderBy('id')
//            ->executeQuery();
//
//        return $stmt->fetchAllAssociative();
//    }

    public function getAllList()
    {
        $qb = $this->repository->createQueryBuilder('u')
            ->join('u.todos', 't')
            ->addSelect('t');

        return $qb->getQuery()->getResult();
    }
}