<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Doctrine\DBAL\Types;

use App\User\Domain\Model\Role;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class RoleType extends StringType
{
    public const NAME = 'user_user_role';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return $value instanceof Role ? $value->getName() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Role
    {
        return !empty($value) ? new Role($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform) : bool
    {
        return true;
    }
}

