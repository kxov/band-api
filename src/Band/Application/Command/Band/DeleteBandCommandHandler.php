<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Band;

use App\Band\Domain\Model\BandRepositoryInterface;

class DeleteBandCommandHandler
{
    private BandRepositoryInterface $bandRepository;

    public function __construct(BandRepositoryInterface $bandRepository)
    {
        $this->bandRepository = $bandRepository;
    }

    public function handle(DeleteBandCommand $command): void
    {
        $todo = $this->bandRepository->get($command->id);

        $this->bandRepository->remove($todo);
    }
}