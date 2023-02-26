<?php

declare(strict_types=1);

namespace App\Tests\Tools;

use App\Tests\Resource\Fixture\UserFixture;
use App\Band\Domain\Model\Band;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use App\Tests\Resource\Fixture\BandFixture;

trait FixtureTools
{
    public function getDatabaseTools(): AbstractDatabaseTool
    {
        return static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function loadFixtures(): array
    {
        $executor = $this->getDatabaseTools()->loadFixtures([UserFixture::class, BandFixture::class]);

        $user = $executor->getReferenceRepository()->getReference(UserFixture::REFERENCE);
        $band = $executor->getReferenceRepository()->getReference(BandFixture::REFERENCE);

        return [ $user, $band ];
    }

    public function loadBandFixture(): Band
    {
//        $executor = $this->getDatabaseTools()->loadFixtures([BandFixture::class]);
//
//        /** @var Band $band */
//        $band = $executor->getReferenceRepository()->getReference(BandFixture::REFERENCE);
//
//        return $band;
    }
}
