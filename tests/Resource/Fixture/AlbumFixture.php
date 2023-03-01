<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixture;

use App\Band\Domain\Model\Album;
use App\Tests\Tools\FakerTools;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AlbumFixture extends Fixture implements DependentFixtureInterface
{
    use FakerTools;

    const REFERENCE = 'album';

    public function load(ObjectManager $manager)
    {
        $album = new Album(
            $this->getFaker()->word(),
            new \DateTimeImmutable(),
            $this->getReference(BandFixture::REFERENCE)
        );

        $manager->persist($album);
        $manager->flush();

        $this->addReference(self::REFERENCE, $album);
    }

    public function getDependencies(): array
    {
        return [
            BandFixture::class,
        ];
    }
}