<?php

declare(strict_types=1);

namespace App\Application\Todo\Create;

use App\Infrastructure\Request\RequestApiInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class Command implements RequestApiInterface
{
    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    public string $name;
}
