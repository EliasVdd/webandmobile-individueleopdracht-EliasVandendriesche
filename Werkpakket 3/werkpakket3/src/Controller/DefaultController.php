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
     * @Route("/adminPage", name="adminroute")
     * @Security("has_role('Admin')")
     */
    public function showAdminPage(Request $request)
    {
        return $this->render('user.html.twig');
    }

    /**
     * @Route("/user", name="userroute")
     * @Security("has_role('User') or has_role('Admin') or has_role('Moderator')")
     */
    public function showUserPage(Request $request)
    {
        return $this->render('user.html.twig');
    }
}
