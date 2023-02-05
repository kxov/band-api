<?php

declare(strict_types=1);

namespace Functional\UI\HTTP\API;

use App\Tests\Tools\FixtureTools;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class TodoControllerTest extends WebTestCase
{
    use FixtureTools;

    public function test_get()
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, '/api/todo/create');

        self::assertEquals(405, $client->getResponse()->getStatusCode());
    }

    public function test_post_success_create()
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

        $client->request('POST', '/api/todo/create', [], [], [], json_encode([
            'name' => 'todo_name',
        ]));

        self::assertEquals(201, $client->getResponse()->getStatusCode());
    }
}