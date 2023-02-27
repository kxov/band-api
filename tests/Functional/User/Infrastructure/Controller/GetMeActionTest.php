<?php

declare(strict_types=1);

namespace App\Tests\UI\HTTP\API;

use App\Tests\Functional\BaseWebTestCase;

class GetMeActionTest extends BaseWebTestCase
{
    public function test_get_me_action()
    {
        $this->client->request('GET', '/api/users/me');

        $data = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals(self::$user->getEmail(), $data['email']);
    }
}
