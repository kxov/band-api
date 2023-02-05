<?php

declare(strict_types=1);

namespace App\Application\Todo\Create;

use App\Domain\Security\UserFetcherInterface;
use App\Domain\Todo\Todo;
use App\Infrastructure\Exception\ApiException;
use App\Infrastructure\Repository\TodoRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\SerializerInterface;

class Handler
{
    private TodoRepository $todoRepository;
    private ValidatorInterface $validator;
    private SerializerInterface $serializer;
    private UserFetcherInterface $userFetcher;

    public function __construct(
        TodoRepository $todoRepository,
        ValidatorInterface $validator,
        SerializerInterface $serializer,
        UserFetcherInterface $userFetcher
    ) {
        $this->todoRepository = $todoRepository;
        $this->validator = $validator;
        $this->serializer = $serializer;
        $this->userFetcher = $userFetcher;
    }

    public function handle(Command $command): Todo
    {
        $todo = new Todo($this->userFetcher->getAuthUser(), $command->name);

        $violations = $this->validator->validate($todo);

        if (\count($violations)) {
            $json = $this->serializer->serialize($violations, 'json');

            throw new ApiException($json);
        }

        $this->todoRepository->add($todo);

        return $todo;
    }
}