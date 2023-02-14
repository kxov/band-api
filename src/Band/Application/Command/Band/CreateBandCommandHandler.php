<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Band;

use App\Band\Domain\Model\Band;
use App\Band\Domain\Model\BandRepositoryInterface;

class CreateBandCommandHandler
{
    private BandRepositoryInterface $bandRepository;

    public function __construct(
        BandRepositoryInterface $bandRepository
    ) {
        $this->bandRepository = $bandRepository;
    }

    public function handle(CreateBandCommand $command): void
    {
        $band = new Band($command->name, new \DateTimeImmutable());

        $this->bandRepository->create($band);
    }
}
