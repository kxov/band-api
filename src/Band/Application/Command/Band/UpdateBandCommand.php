<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Band;

use App\Shared\Application\Command\Command;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateBandCommand extends Command
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("int")
     */
    public int $id;

    /**
     * @var string
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
