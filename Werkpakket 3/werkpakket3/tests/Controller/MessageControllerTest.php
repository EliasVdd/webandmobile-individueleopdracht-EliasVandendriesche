<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 31/10/2018
 * Time: 9:57
 */

namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class MessageControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testGetMessageListUnAuthenticated()
    {
        $this->client->request('GET', '/messages');

        $this->assertEquals(500, $this->client->getResponse()->getStatusCode());
    }

    public function testGetMessageList()
    {
        $this->logIn();
        $this->client->request('GET', '/messages');

        //var_dump($this->client->getResponse());
        //var_dump($this->client->getRequest());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testShowMessageIndexTemplate()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'jonas',
            'PHP_AUTH_PW'   => 'joskebammens',
        ));

        $crawler = $client->request('GET', '/messages');

        $this->assertTrue(true);

    }

    private function logIn()
    {
        $session = $this->client->getContainer()->get('session');

        $firewallName = 'secured_area';
        // if you don't define multiple connected firewalls, the context defaults to the firewall name
        // See https://symfony.com/doc/current/reference/configuration/security.html#firewall-context
        $firewallContext = 'secured_area';

        // you may need to use a different token class depending on your application.
        // for example, when using Guard authentication you must instantiate PostAuthenticationGuardToken
        $token = new UsernamePasswordToken('test', 'test', $firewallName, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }

}