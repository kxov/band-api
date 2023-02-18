<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Console;

use App\User\Domain\Model\UserFactory;
use App\User\Domain\Model\UserRepositoryInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:users:create-user',
    description: 'create user',
)]
final class CreateUser extends Command
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserFactory            $userFactory,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $email = $io->ask(
            'email',
            null,
            function (?string $email) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new \Exception('Email is invalid');
                }

                return $email;
            }
        );

        $password = $io->askHidden(
            'password',
            function (?string $password) {
                if (!$password) {
                    throw new \Exception('Password cannot be empty');
                }

                return $password;
            }
        );

        $user = $this->userFactory->create($email, $password);
        $this->userRepository->add($user);

        return Command::SUCCESS;
    }
}
