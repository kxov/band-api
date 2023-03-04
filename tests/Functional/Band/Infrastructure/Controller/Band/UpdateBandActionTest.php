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

        $this->client->request(Request::METHOD_POST, '/api/band/update', [], [], [], json_encode([
            'id' => $band->getId(),
            'name' => $newBandName = RandomGenerateValue::getName()
        ]));

        self::assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}
