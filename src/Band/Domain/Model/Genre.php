<?php

declare(strict_types=1);

namespace App\Band\Domain\Model;

class Genre
{
    private int $id;
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
