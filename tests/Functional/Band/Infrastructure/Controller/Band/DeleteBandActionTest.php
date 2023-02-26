<?php

declare(strict_types=1);

namespace Functional\Band\Infrastructure\Controller\Band;

use App\Tests\Functional\BaseWebTestCase;
use Symfony\Component\HttpFoundation\Request;

class DeleteBandActionTest extends BaseWebTestCase
{
    public function test_post()
    {
        $this->client->request(Request::METHOD_POST, '/api/band/delete');

        self::assertEquals(405, $this->client->getResponse()->getStatusCode());
    }

    public function test_delete_band_success()
    {
        $this->client->request(Request::METHOD_DELETE, '/api/band/delete', [], [], [], json_encode([
            'id' => $this->band->getId(),
        ]));

        self::assertEquals(204, $this->client->getResponse()->getStatusCode());
    }
}
