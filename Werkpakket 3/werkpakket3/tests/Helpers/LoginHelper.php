<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 6/11/2018
 * Time: 9:33
 */

namespace App\Tests\Helpers;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class LoginHelper extends WebTestCase
{
    public function logInUser($client)
    {
        $this->logIn($client, 'User', 'User');
    }

    public function logInModerator($client)
    {
        $this->logIn($client, 'Moderator', 'Moderator');
    }

    public function logInAdmin($client)
    {
        $this->logIn($client, 'Admin', 'Admin');
    }

    private function logIn($client, $username, $password)
    {
        $session = $client->getContainer()->get('session');

        $firewallName = 'secured_area';
        // if you don't define multiple connected firewalls, the context defaults to the firewall name
        // See https://symfony.com/doc/current/reference/configuration/security.html#firewall-context
        $firewallContext = 'secured_area';

        // you may need to use a different token class depending on your application.
        // for example, when using Guard authentication you must instantiate PostAuthenticationGuardToken

        $authenticationManager= $client->getContainer()->get('public.authentication.manager');
        $token = $authenticationManager->authenticate(
            new UsernamePasswordToken(
                $username, $password,
                $firewallName
            ));

        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);
    }

}