<?php

namespace App\Tests\Service\API;

use App\Service\API\HTTPClient;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class HTTPClientTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();
        $client = self::getContainer()->get(HTTPClient::class);
        $this->assertEquals('response', $client->send());
    }
}
