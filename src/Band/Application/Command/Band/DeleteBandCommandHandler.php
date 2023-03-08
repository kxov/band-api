<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Band;

use App\Band\Domain\Model\BandRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;

class DeleteBandCommandHandler implements CommandHandlerInterface
{
    private BandRepositoryInterface $bandRepository;

    public function __construct(BandRepositoryInterface $bandRepository)
    {
        $this->bandRepository = $bandRepository;
    }

    public function __invoke(DeleteBandCommand $command): void
    {
        $band = $this->bandRepository->get($command->id);

        $this->bandRepository->remove($band);
    }
}
