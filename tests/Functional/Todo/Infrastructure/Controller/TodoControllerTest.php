<?php

declare(strict_types=1);

namespace Functional\Todo\Infrastructure\Controller;

use App\Tests\Functional\BaseWebTestCase;
use App\Tests\Tools\FixtureTools;
use Symfony\Component\HttpFoundation\Request;

class TodoControllerTest extends BaseWebTestCase
{
    use FixtureTools;

    public function test_get()
    {
        $this->client->request(Request::METHOD_GET, '/api/todo/create');

        self::assertEquals(405, $this->client->getResponse()->getStatusCode());
    }

    public function test_post_success_create()
    {
        $this->client->request('POST', '/api/todo/create', [], [], [], json_encode([
            'name' => 'todo_name',
        ]));

        self::assertEquals(201, $this->client->getResponse()->getStatusCode());
    }
}