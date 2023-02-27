<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Band\Domain\Model\Band;
use App\Tests\Resource\Fixture\UserFixture;
use App\Tests\Tools\FixtureTools;
use App\User\Domain\Model\User;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class BaseWebTestCase extends WebTestCase
{
    use FixtureTools;

    protected KernelBrowser $client;

    protected string $jwtToken;

    protected static $user = null;

    protected $fixtureLoader;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();

        //if (!self::$user) {

            self::$user = $this->loadFixtures(UserFixture::class);

            $this->client->request(
                'POST',
                '/api/auth/token/login',
                [],
                [],
                ['CONTENT_TYPE' => 'application/json'],
                json_encode([
                    'email' => self::$user->getEmail(),
                    'password' => self::$user->getPassword(),
                ])
            );
            $data = json_decode($this->client->getResponse()->getContent(), true);

            $this->jwtToken = $data['token'];

            $this->client->setServerParameter('HTTP_AUTHORIZATION', sprintf('Bearer %s', $this->jwtToken));
        //}
    }

//    public function loadFixtures(array $fixtures, bool $append = false): void
//    {
//        $this->fixtureLoader = new Loader();
//        $entityManager = self::$container->get('doctrine')->getManager();
//        $ormExecutor = new ORMExecutor($entityManager, new ORMPurger($entityManager));
//
//        $consoleLogger = new ConsoleLogger(new ConsoleOutput(ConsoleOutput::VERBOSITY_DEBUG));
//        $ormExecutor->setLogger(function ($message) use ($consoleLogger) {
//            $consoleLogger->info($message);
//        });
//        foreach ($fixtures as $fixture) {
//            $this->fixtureLoader->addFixture($fixture);
//        }
//        foreach ($this->fixtureLoader->getFixtures() as $fixture) {
//            if ($fixture instanceof ContainerAwareInterface) {
//                $fixture->setContainer(self::$container);
//            }
//        }
//        $ormExecutor->execute($this->fixtureLoader->getFixtures(), $append);
//    }
}
