<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Band;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateBandCommand
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("int")
     */
    public int $id;

    /**
     * @var string|null
     * @Assert\Type("string")
     */
    public ?string $name = null;

    /**
     * @Assert\Type("DateTimeInterface")
     */
    public ?\DateTimeInterface $dateCreate = null;

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'name' => $this->name,
            'dateCreate' => $this->dateCreate?->format('d/m/Y')
        ]);
    }
}
