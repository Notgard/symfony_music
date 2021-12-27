<?php
declare(strict_types=1);

namespace App\Tests\Controller;

use App\Controller\HelloController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use PHPUnit\Framework\TestCase;

class HelloControllerTest extends WebTestCase
{

    public function testHelloManyTimes()
    {
        $client = static::createClient();

        $client->request('GET', '/hello/bob');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertCount(3, $client->getCrawler()->filter('h1'));
    }
}
