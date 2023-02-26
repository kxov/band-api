<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixture;

use App\Band\Domain\Model\Band;
use App\Band\Domain\Model\BandRepositoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Tests\Tools\FakerTools;

class BandFixture extends Fixture
{
    use FakerTools;

    const REFERENCE = 'band';

    public function __construct(private readonly BandRepositoryInterface $bandRepository)
    {
    }

    public function load(ObjectManager $manager)
    {
        $band = new Band($this->getFaker()->word());

        $this->bandRepository->create($band);

        $this->addReference(self::REFERENCE, $band);
    }
}
