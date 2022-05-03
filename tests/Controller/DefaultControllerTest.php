<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
     * @dataProvider providePublicUrls
     */
    public function testPublicUrls(string $url, int $code): void
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $this->assertResponseStatusCodeSame($code, $client->getResponse()->getStatusCode());
    }

    public function providePublicUrls(): array
    {
        return [
            ['/', 200],
            ['/contact', 200],
            ['/book', 200],
            ['/disk', 404],
        ];
    }
}
