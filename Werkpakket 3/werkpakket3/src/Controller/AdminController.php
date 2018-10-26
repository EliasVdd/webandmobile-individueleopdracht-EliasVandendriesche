<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("has_role('Admin')")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_userlist")
     */
    public function adminPage()
    {
        $repository = $this->getDoctrine()
            ->getRepository(User::class);

        $users = $repository->findAll();

        return $this->render(
            'admin/admin.html.twig',
            array('users' => $users)
        );
    }

    /**
     * @Route("/admin/edit/{id}", name="edit_user")
     */
    public function edit($id)
    {
        $repository = $this->getDoctrine()
            ->getRepository(User::class);

        $user = $repository->find($id);


              return $this->render(
            'admin/edit.html.twig',
            array("user" => $user)
        );
    }

    /**
     * @Route("/admin/delete/{id}", name="delete_user")
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);

        if (!$user) { // no user in the system
            throw $this->createNotFoundException(
                'No user found for id ' . $id
            );
        } else {
            $em->remove($user);
            $em->flush();
          
            return $this->redirectToRoute('admin_userlist');
        }
    }
    /**
     * @Route("/admin/register", name="register_user")
     */
    public function register()
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user, array(
            'action' => $this->generateUrl('app_registerUser'),
        ));

        return $this->render(
            'admin/register.html.twig',
            array('form' => $form->createView())
        );
    }

}
