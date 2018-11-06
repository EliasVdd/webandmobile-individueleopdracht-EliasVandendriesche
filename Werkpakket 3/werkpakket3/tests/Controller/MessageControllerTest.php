<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 31/10/2018
 * Time: 9:57
 */

namespace App\Tests\Controller;


use App\Controller\MessageController;
use App\Entity\Message;
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

    //Jonas
    public function testGetMessageListWhileAnonymous()
    {
        $this->client->request('GET', '/messages');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    //Jonas
    public function testGetMessageList()
    {
        $this->loginHelper->logInUser($this->client);
        $this->client->request('GET', '/messages');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    //Jonas
    public function testShowMessageIndexTemplate()
    {
        $this->loginHelper->logInUser($this->client);

        $crawler = $this->client->request('GET', '/messages');

        $this->assertGreaterThan(
            0,
            $crawler->filter('a:contains("Add Message")')->count()
        );
    }

    //Jonas
    public function testShowAddMessageForm()
    {
        $this->loginHelper->loginUser($this->client);

        $crawler = $this->client->request('GET', '/message');

        $this->assertGreaterThan(
            0,
            $crawler->filter('h1:contains("Create new message")')->count()
        );
    }

    //Jonas
    public function testShowAddMessageFormReturnAccessDeniedPageWhenNotAuthenticated()
    {
        $crawler = $this->client->request('GET', '/message');

        $this->assertGreaterThan(
            0,
            $crawler->filter('h1:contains("Access denied")')->count()
        );
    }

    //Jonas
    public function testAdminGetsOptionToDeleteAndUpdateMessages()
    {
        $this->loginHelper->loginAdmin($this->client);

        $crawler = $this->client->request('GET', '/messages');

        $this->assertGreaterThan(0, $crawler->filter('a.fa-trash-alt')->count());
        $this->assertGreaterThan(0, $crawler->filter('a.fa-pencil-alt')->count());
    }



}