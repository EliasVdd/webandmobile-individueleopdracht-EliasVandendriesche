<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 3/11/2018
 * Time: 11:18
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\Helpers\LoginHelper;

class CategoryControllerTest extends WebTestCase
{
    private $client = null;
    private $loginHelper = null;

    public function setUp()
    {
        $this->client = static::createClient();
        $this->loginHelper = new LoginHelper();
    }

    //Jonas
    public function testGetCategoriesIndexReturnsRedirectWhenAnonymous()
    {
        $this->client->request('GET', '/categories');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    //Jonas
    public function testGetCategoriesIndexReturns200WhenAdminOrModerator()
    {
        $this->loginHelper->loginAdmin($this->client);

        $this->client->request('GET', '/categories');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    //Jonas
    public function testGetCategoryFormReturnsFormWhenModerator()
    {
        $this->loginHelper->loginAdmin($this->client);

        $crawler = $this->client->request('GET', '/category');

        $this->assertGreaterThan(
            0,
            $crawler->filter('h1.display-4:contains("Create a new category")')->count()
        );
        $this->assertGreaterThan(
            0,
            $crawler->filter('label:contains("Name")')->count()
        );
        $this->assertGreaterThan(
            0,
            $crawler->filter('button:contains("Save")')->count()
        );
    }

    //Jonas
    public function testGetCategoryFormReturns200WhenModerator()
    {
        $this->loginHelper->loginModerator($this->client);

        $this->client->request('GET', '/category');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

}