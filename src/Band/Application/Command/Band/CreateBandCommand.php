<?php

declare(strict_types=1);

namespace App\Band\Application\Command\Band;

use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateBandCommand
{
    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    public string $name;

    /**
     * @Assert\Type("\DateTimeInterface")
     */
    public DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = $this->createdAt ?? new DateTimeImmutable();
    }
}
