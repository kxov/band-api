<?php

declare(strict_types=1);

namespace App\Tests\Functional\UI\HTTP\API;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class HealthCheckActionTest extends WebTestCase
{
    public function test_request_responded_success_result(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, '/health');

        $this->assertResponseIsSuccessful();

        $jsonResult = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals('ok', $jsonResult['status']);
    }
}
