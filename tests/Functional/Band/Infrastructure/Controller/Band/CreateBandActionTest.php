<?php

declare(strict_types=1);

namespace Functional\Band\Infrastructure\Controller\Band;

use App\Tests\Tools\FixtureTools;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateBandActionTest extends WebTestCase
{
    use FixtureTools;

    public function test_create_band_success()
    {
        $client = static::createClient();
        $user = $this->loadUserFixture();

        $client->request(
            'POST',
            '/api/auth/token/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
            ])
        );
        $data = json_decode($client->getResponse()->getContent(), true);

        $client->setServerParameter('HTTP_AUTHORIZATION', sprintf('Bearer %s', $data['token']));

        $client->request('POST', '/api/band/create', [], [], [], json_encode([
            'name' => 'band_name',
        ]));

        self::assertEquals(201, $client->getResponse()->getStatusCode());
    }
}