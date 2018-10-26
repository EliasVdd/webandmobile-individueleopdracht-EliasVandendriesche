<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

class SecurityController extends AbstractController
{
    public function SecurityController(){

    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/login_check", name="checkroute")
     */
    public function loginCheck()
    {

    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register (){
        $user = new User();
        $form = $this->createForm(UserType::class, $user, array(
            'action' => $this->generateUrl('app_registerUser')
        ));

        return $this->render(
            'security/register.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/registerUser", name="app_registerUser")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(UserType::class, new User());

        $form->handleRequest($request);

        if ($form->isValid()) {
            $user = $form->getData();

            $encoder = new BCryptPasswordEncoder(12);

            $user->setPassword($encoder->encodePassword($user->getPassword(), 12));

            $em->persist($user->getUser());
            $em->flush();

            return $this->redirectToRoute('defaultroute');
        }

        return $this->render(
            'security/register.html.twig',
            array('form' => $form->createView())
        );
    }

    

    /**
     * @Route("/quit", name="app_quit")
     */
    public function quitAction(Request $request)
    {

    }
}
