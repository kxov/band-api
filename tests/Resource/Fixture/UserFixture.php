<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixture;

use App\Tests\Tools\FakerTools;
use App\User\Domain\Model\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    use FakerTools;
    const REFERENCE = 'user';

    public function __construct(private readonly UserFactory $userFactory)
    {
    }

    public function load(ObjectManager $manager)
    {
        $email = $this->getFaker()->email();
        $password = $this->getFaker()->password();

        $user = $this->userFactory->create($email, $password);

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::REFERENCE, $user);
    }
}