<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 3/11/2018
 * Time: 11:18
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testGetCategoriesIndex()
    {
        $this->client->request('GET', '/categories');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

}