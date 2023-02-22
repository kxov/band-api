<?php

declare(strict_types=1);

namespace Unit\User\Domain\Model;

use App\Tests\Builder\User\UserBuilder;
use App\User\Domain\Model\Role;
use PHPUnit\Framework\TestCase;

class RoleTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->build();

        $user->changeRole(Role::admin());

        $roles = $user->getRoles();

        self::assertEquals(reset($roles), Role::ADMIN);

        //self::assertTrue($user->getRoles()->isAdmin());
    }
}
