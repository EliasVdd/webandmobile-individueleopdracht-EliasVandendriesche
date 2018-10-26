<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Security("has_role('Admin')")
 */
class AdminController extends AbstractController
{
    /**
    * @Route("/admin"), name="admin_userlist"
    */
    public function adminPage() {

    }

     /**
     * @Route("/admin/register", name="app_admin_register")
     */
    public function register (){
        $user = new User();
        $form = $this->createForm(UserType::class, $user, array(
            'action' => $this->generateUrl('app_registerUser')
        ));

        return $this->render(
            'admin/register.html.twig',
            array('form' => $form->createView())
        );
    }


}