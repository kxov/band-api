<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Band;

use App\Band\Domain\Model\Band;
use App\Band\Domain\Model\BandRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateBandCommandHandler implements CommandHandlerInterface
{
    private BandRepositoryInterface $bandRepository;

    public function __construct(
        BandRepositoryInterface $bandRepository
    ) {
        $this->bandRepository = $bandRepository;
    }

    public function __invoke(CreateBandCommand $command): void
    {
        $band = new Band($command->name, $command->createdAt);

        $this->bandRepository->create($band);
    }
}
