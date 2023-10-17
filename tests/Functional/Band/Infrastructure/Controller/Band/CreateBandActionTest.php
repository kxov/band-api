<?php

declare(strict_types=1);

namespace Functional\Band\Infrastructure\Controller\Band;

use App\Tests\Functional\BaseWebTestCase;

/**
 * @group createBand
 */
class CreateBandActionTest extends BaseWebTestCase
{
    public function test_create_band_success()
    {
        $this->client->jsonRequest('POST', '/api/band/create', ["name" => "judas priest"]);

        self::assertEquals(201, $this->client->getResponse()->getStatusCode());
    }
}
