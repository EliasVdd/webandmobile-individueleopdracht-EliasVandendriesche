<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 31/10/2018
 * Time: 9:57
 */

namespace App\Tests\Controller;


use App\Tests\Helpers\LoginHelper;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MessageControllerTest extends WebTestCase
{
    private $client = null;
    private $loginHelper = null;

    public function setUp()
    {
        $this->client = static::createClient();
        $this->loginHelper = new LoginHelper();
    }

    public function testGetMessageListWhileAnonymous()
    {
        $this->client->request('GET', '/messages');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testGetMessageList()
    {
        $this->loginHelper->logInUser($this->client);
        $this->client->request('GET', '/messages');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testShowMessageIndexTemplate()
    {
        $this->loginHelper->logInUser($this->client);

        $crawler = $this->client->request('GET', '/messages');

        $this->assertTrue(true);

    }

}