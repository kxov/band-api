<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Band;

use App\Band\Domain\Model\BandRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class UpdateBandCommandHandler
{
    private BandRepositoryInterface $bandRepository;

    private DenormalizerInterface $denormalizer;

    private EntityManagerInterface $entityManager;

    public function __construct(
        BandRepositoryInterface $bandRepository,
        EntityManagerInterface $entityManager,
        DenormalizerInterface $denormalizer
    )
    {
        $this->bandRepository = $bandRepository;
        $this->entityManager = $entityManager;
        $this->denormalizer = $denormalizer;
    }

    public function handle(UpdateBandCommand $command): void
    {
        $band = $this->bandRepository->get($command->id);

        $updateBandDto = UpdateBandDto::fromBand($band);

        /** @var UpdateBandDto $updateRequest */
        $updateRequest = $this->denormalizer->denormalize(
            $command->toArray(),
            UpdateBandDto::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $updateBandDto]
        );

        $band->update($updateRequest->name, $updateRequest->dateCreate);

        $this->entityManager->flush();
    }
}
