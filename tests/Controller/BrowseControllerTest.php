<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BrowseControllerTest extends WebTestCase
{
    public function testArtists()
    {
        $client = static::createClient();

        $client->request('GET', '/artists');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $liList = $client->getCrawler()->filter('li');
        $this->assertCount(89, $liList);
        $this->assertSame('A Perfect Circle', $liList->first()->text());
        $this->assertSame('ZZ Top', $liList->last()->text());

        $link = $client->getCrawler()->selectLink('Metallica')->link();
        $client->click($link);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testAlbums()
    {
        $client = static::createClient();

        $client->request('GET', '/albums/17');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $liList = $client->getCrawler()->filter('li');
        $this->assertCount(18, $liList);
        $this->assertSame('Sucking My Love', $liList->first()->text());
        $this->assertSame('The Big 4: Live From Sofia, Bulgaria', $liList->last()->text());

        $client->request('GET', '/albums/400');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testTracks()
    {
        $client = static::createClient();

        $client->request('GET', '/tracks/4');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $liList = $client->getCrawler()->filter('li');
        $this->assertCount(14, $liList);

        $client->request('GET', '/tracks/400000');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
