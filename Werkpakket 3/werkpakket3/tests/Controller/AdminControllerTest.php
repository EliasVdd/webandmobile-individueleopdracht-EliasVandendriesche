<?php

namespace App\Tests\Controller;

use App\Tests\Helpers\LoginHelper;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    private $client = null;
    private $loginHelper = null;

    public function setUp()
    {
        $this->client = static::createClient();
        $this->loginHelper = new LoginHelper();
    }

    //Elias
    public function testGetUserListWhileAdmin()
    {
        $this->loginHelper->logInAdmin($this->client);

        $this->client->request('GET', '/admin');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    //Elias
    public function testGetUserListWhileAnonymous()
    {
        $this->client->request('GET', '/admin');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    //Elias
    public function testUserListPageIsLoaded()
    {
        $this->loginHelper->logInAdmin($this->client);

        $crawler = $this->client->request('GET', '/admin');

        $this->assertGreaterThan(
            0,
            $crawler->filter('a:contains("Add User")')->count()
        );
    }

    //Elias
    public function testShowAddUserForm()
    {
        $this->loginHelper->logInAdmin($this->client);

        $crawler = $this->client->request('GET', '/admin/register');

        $this->assertGreaterThan(
            0,
            $crawler->filter('h1:contains("Create User")')->count()
        );
    }

    //Elias
    public function testAdminGetsOptionToDeleteAndUpdateUsers()
    {
        $this->loginHelper->logInAdmin($this->client);

        $crawler = $this->client->request('GET', '/admin');

        $this->assertGreaterThan(0, $crawler->filter('i.fas.fa-pencil-alt')->count());
        $this->assertGreaterThan(0, $crawler->filter('i.fas.fa-trash-alt')->count());
    }

    //Elias
    public function testAdminAddUser()
    {
        $this->loginHelper->logInAdmin($this->client);

        $crawler = $this->client->request('GET', '/admin/register');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'user[userName]' => 'Test',
            'user[password]' => 'Test',
            'user[rolesString]' => 'ROLE_USER',
        ));

        $this->client->submit($form);

        $this->assertTrue($this->client->getResponse()->isRedirect());
        $crawler = $this->client->followRedirect();

        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');
    }

    //Elias
    public function testAdminEditUser()
    {
        $this->loginHelper->logInAdmin($this->client);

        $crawler = $this->client->request('GET', '/admin');

        $link = $crawler->filter('tr:contains("Test")')->filter('a[id="editUser"]')->attr('href');

        $crawler = $this->client->request('GET', $link);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Update')->form(array(
            'username' => 'TestEdit',
            'rolesString' => 'ROLE_USER'
        ));

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        $this->assertEquals(1, $crawler->filter('td:contains("TestEdit")')->count(), 'element td:contains("TestEdit") does not exist');
    }

    //Elias
    public function testAdminDeleteUser()
    {
        $this->loginHelper->logInAdmin($this->client);

        $crawler = $this->client->request('GET', '/admin');

        $link = $crawler->filter('tr:contains("TestEdit")')->filter('a[id="deleteUser"]')->attr('href');

        $crawler = $this->client->request('GET', $link);
        $crawler = $this->client->followRedirect();

        $this->assertEquals(0, $crawler->filter('td:contains("TestEdit")')->count(), 'element td:contains("TestEdit") still exists');
    }
}
