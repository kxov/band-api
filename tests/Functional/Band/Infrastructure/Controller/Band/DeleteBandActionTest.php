<?php

declare(strict_types=1);

namespace Functional\Band\Infrastructure\Controller\Band;

use App\Tests\Functional\BaseWebTestCase;
use App\Tests\Resource\Fixture\BandFixture;
use App\Tests\Tools\FixtureTools;
use Symfony\Component\HttpFoundation\Request;

class DeleteBandActionTest extends BaseWebTestCase
{
    use FixtureTools;

    public function test_post()
    {
        $this->client->jsonRequest(Request::METHOD_POST, '/api/band/delete');

        self::assertEquals(405, $this->client->getResponse()->getStatusCode());
    }

    public function test_delete_band_success()
    {
        $band = $this->loadFixtures(BandFixture::class, true);

        $this->client->jsonRequest(Request::METHOD_DELETE, '/api/band/delete', ['id' => $band->getId()]);

        self::assertEquals(204, $this->client->getResponse()->getStatusCode());
    }
}
