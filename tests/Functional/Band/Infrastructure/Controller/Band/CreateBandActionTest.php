<?php

declare(strict_types=1);

namespace Functional\Band\Infrastructure\Controller\Band;

use App\Tests\Functional\BaseWebTestCase;

class CreateBandActionTest extends BaseWebTestCase
{
    public function test_create_band_success()
    {
        $this->client->request('POST', '/api/band/create', [], [], [], json_encode([
            'name' => 'band_name',
        ]));

        self::assertEquals(201, $this->client->getResponse()->getStatusCode());
    }
}