<?php

namespace App\Controller;

use http\Env\Request;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
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
        return new Response();
    }

    /**
     * @Route("/user", name="userroute")
     */
    public function showUserPage(Request $request)
    {
        return new Response();
    }
}
