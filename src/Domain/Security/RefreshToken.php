<?php

declare(strict_types=1);

namespace App\Domain\Security;

use Doctrine\ORM\Mapping as ORM;
use Gesdinet\JWTRefreshTokenBundle\Entity\RefreshToken as BaseRefreshToken;

/**
 * @ORM\Entity
 * @ORM\Table("refresh_tokens")
 */
class RefreshToken extends BaseRefreshToken
{
}
