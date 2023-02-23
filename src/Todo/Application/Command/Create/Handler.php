<?php

declare(strict_types=1);

namespace App\Todo\Application\Command\Create;

use App\Shared\Domain\Security\UserFetcherInterface;
use App\Shared\Infrastructure\Exception\ApiException;
use App\Todo\Domain\Model\Todo;
use App\Todo\Infrastructure\Repository\TodoRepository;
use App\User\Domain\Model\UserRepositoryInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Handler
{
    private TodoRepository $todoRepository;
    private ValidatorInterface $validator;
    private SerializerInterface $serializer;
    private UserFetcherInterface $userFetcher;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        TodoRepository $todoRepository,
        UserRepositoryInterface $userRepository,
        ValidatorInterface $validator,
        SerializerInterface $serializer,
        UserFetcherInterface $userFetcher
    ) {
        $this->todoRepository = $todoRepository;
        $this->userRepository = $userRepository;
        $this->validator = $validator;
        $this->serializer = $serializer;
        $this->userFetcher = $userFetcher;
    }

    public function handle(Command $command): Todo
    {
        $user = $this->userRepository->findById($this->userFetcher->getAuthUser()->getId());

        $todo = new Todo($user, $command->name);

        $violations = $this->validator->validate($todo);

        if (\count($violations)) {
            $json = $this->serializer->serialize($violations, 'json');

            throw new ApiException($json);
        }

        $this->todoRepository->add($todo);

        return $todo;
    }
}