<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Band;

use App\Band\Domain\Model\Band;

class UpdateBandDto
{
    private int $id;

    public ?string $name = null;

    public ?\DateTimeImmutable $dateCreate = null;

    public static function fromBand(Band $band): self
    {
        $updateBandDto = new self();

        $updateBandDto->id = $band->getId();
        $updateBandDto->name = $band->getName();
        $updateBandDto->dateCreate = $band->getDateCreate();

        return $updateBandDto;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
