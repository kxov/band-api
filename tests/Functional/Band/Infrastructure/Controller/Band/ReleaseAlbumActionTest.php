<?php

declare(strict_types=1);

namespace Functional\Band\Infrastructure\Controller\Band;

use App\Tests\Functional\BaseWebTestCase;
use App\Tests\Resource\Fixture\BandFixture;
use App\Tests\Tools\FixtureTools;
use App\Tests\Unit\Util\RandomGenerateValue;
use Symfony\Component\HttpFoundation\Request;

class ReleaseAlbumActionTest extends BaseWebTestCase
{
    use FixtureTools;

    public function test_release_band_album_success()
    {
        $band = $this->loadFixtures(BandFixture::class, true);

        $this->client->request(Request::METHOD_POST, sprintf('/api/band/%d/album/release', $band->getId()), [], [], [], json_encode([
            'albumName' => RandomGenerateValue::getName(),
        ]));

        self::assertEquals(201, $this->client->getResponse()->getStatusCode());
    }
}
