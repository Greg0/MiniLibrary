<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LuckyControllerControllerTest extends WebTestCase
{
    public function testNumber()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/number');
    }

}
