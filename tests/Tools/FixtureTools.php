<?php

declare(strict_types=1);

namespace App\Tests\Tools;

use App\Domain\User\User;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use App\Tests\Resource\Fixture\UserFixture;

trait FixtureTools
{
    public function getDatabaseTools(): AbstractDatabaseTool
    {
        return static::getContainer()->get(DatabaseToolCollection::class)->get();
    }
    public function loadUserFixture(): User
    {
        $executor = $this->getDatabaseTools()->loadFixtures([UserFixture::class]);
        /** @var User $user */
        $user = $executor->getReferenceRepository()->getReference(UserFixture::REFERENCE);

        return $user;
    }
}
