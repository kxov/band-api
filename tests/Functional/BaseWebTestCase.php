<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Resource\Fixture\UserFixture;
use App\Tests\Tools\FixtureTools;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BaseWebTestCase extends WebTestCase
{
    use FixtureTools;

    protected KernelBrowser $client;

    protected string $jwtToken;

    protected Object $user;

    protected $fixtureLoader;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();

        $this->user = $this->loadFixtures(UserFixture::class);

        $this->client->request(
            'POST',
            '/api/auth/token/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'email' => $this->user->getEmail(),
                'password' => $this->user->getPassword(),
            ])
        );
        $data = json_decode($this->client->getResponse()->getContent(), true);
        $this->jwtToken = $data['token'];

        $this->client->setServerParameter('HTTP_AUTHORIZATION', sprintf('Bearer %s', $this->jwtToken));
    }
}
