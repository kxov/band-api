<?php

declare(strict_types=1);

namespace App\Shared\Application\Command;

class Command implements CommandInterface
{
    private array $properties = [];

    public function __set($name, $value)
    {
        $this->properties[$name] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        return null;
    }
}