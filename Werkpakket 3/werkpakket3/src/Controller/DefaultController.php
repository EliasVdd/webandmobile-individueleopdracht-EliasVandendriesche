<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/admin", name="adminroute")
     */
    public function showAdminPage(Request $request)
    {
        return $this->render('user.html.twig');
    }

    /**
     * @Route("/user", name="userroute")
     */
    public function showUserPage(Request $request)
    {
        return new Response();
    }
}