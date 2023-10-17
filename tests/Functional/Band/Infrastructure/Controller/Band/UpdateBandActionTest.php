<?php

declare(strict_types=1);

namespace Functional\Band\Infrastructure\Controller\Band;

use App\Tests\Functional\BaseWebTestCase;
use App\Tests\Resource\Fixture\BandFixture;
use App\Tests\Unit\Util\RandomGenerateValue;
use Symfony\Component\HttpFoundation\Request;

class UpdateBandActionTest extends BaseWebTestCase
{
    public function test_update_band_success()
    {
        $band = $this->loadFixtures(BandFixture::class, true);

        $this->client->jsonRequest(Request::METHOD_POST, '/api/band/update',
            [
                'id' => $band->getId(),
                'name' => RandomGenerateValue::getName()
            ]
        );

        self::assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}
