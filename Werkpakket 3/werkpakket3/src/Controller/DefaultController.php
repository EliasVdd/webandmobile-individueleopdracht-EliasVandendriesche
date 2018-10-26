<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="defaultroute")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/home", name="homeroute")
     * @Security("has_role('User') or has_role('Admin')or has_role('Moderator')")
     */
    public function showHomePage(Request $request)
    {
        return $this->render('home.html.twig');
    }
}
