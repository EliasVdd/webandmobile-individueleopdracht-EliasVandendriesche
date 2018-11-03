<?php

namespace App\Controller;

use App\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Message;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Reaction;
use App\Form\ReactionType;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_USER') or has_role('ROLE_ADMIN')or has_role('ROLE_MODERATOR')")
 */
class MessageController extends AbstractController
{
    
    public function __construct()
    {
    }

    /**
     * @Route("/messages", name="messages")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(ReactionType::class, new Reaction());

        $messages = $this->getDoctrine()
            ->getRepository(Message::class)
            ->findAll();

        return $this->render('message/index.html.twig', [
            'messages' => $messages,      
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/message", methods={"GET", "POST"} , name="getmessage")
     */
    public function showMessageForm(Request $request)
    {
        $form = $this->createForm(MessageType::class, new Message());

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $message = new Message();
            $formData = $form->getData();
            $message->setContent($formData->getContent());
            $message->setUserid($this->getUser()->getId());
            $message->setCategory($formData->getCategory()->getId());

            $this->postMessage($message);

            return $this->redirectToRoute('messages');
        }

        return $this->render('message/addMessage.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/deletemessage/{id}", name="deletemessage")
     */
    public function deleteMessage($id) {
        $em = $this->getDoctrine()->getManager();

        $message = $em->find(Message::class, $id);

        if($message == null)
        {
            return;
        }

        $em->remove($message);
        $em->flush();

        return $this->redirectToRoute('messages');
    }

    /**
     * @Route("/updatemessage/{id}", name="updatemessage")
     */
    public function updateMessage($id) {
        $em = $this->getDoctrine()->getManager();

        $message = $em->find(Message::class, $id);

        if($message == null)
        {
            return;
        }

        return $this->redirectToRoute('getmessage',array('message' => $message));
    }

    /**
     * @Route("/message/react/{id}", methods={"GET", "POST"}, name="react_to_message")
     */
    public function reactToMessage(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        
        $form = $this->createForm(ReactionType::class, new Reaction());

        $message = $em->find(Message::class, $id);

        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $reaction = new Reaction();
            $formData = $form->getData();
            $reaction->setContent($formData->getContent());
            $reaction->setMessage($message);
            $reaction->setUser($this->getUser());
            $reaction->setToken(uniqid('saltvoorextrapunten'.$id, true));
            
            $response = new Response();
            $response->send();
            $response = $this->RedirectToRoute('messages');

            $em->persist($reaction);
            $em->flush();

            $response->headers->setCookie(new Cookie('tokenCookie'.$reaction->getId(), $reaction->getToken(), time() +
            (3600 * 48)));

            $response->headers->setCookie(new Cookie('userCookie'.$reaction->getId(), $this->getUser(), time() +
            (3600 * 48)));
            
            
            return $response;
        }       
    }

    /**
     * @Route("/reaction/edit/{id}", methods={"GET", "POST"}, name="edit_reaction")
     */
    public function editReaction(Request $request,Reaction $reaction) {
        $em = $this->getDoctrine()->getEntityManager();
        
        $editReactionForm = $this->createForm(ReactionType::class, $reaction);

        $editReactionForm->handleRequest($request);

        if($editReactionForm->isSubmitted() && $editReactionForm->isValid())
        {
            
            $em->persist($reaction);
            $em->flush();
            return $this->redirectToRoute('messages');
        }

        return $this->render('Message/editReaction.html.twig', [
            'editReactionForm' => $editReactionForm->createView()
        ]);
    }

     /**
     * @Route("/reaction/delete/{id}", name="delete_reaction")
     */
    public function deleteReaction($id) {
        $em = $this->getDoctrine()->getManager();

        $reaction = $em->find(Reaction::class, $id);

        if($reaction == null)
        {
            return;
        }

        $em->remove($reaction);
        $em->flush();

        return $this->redirectToRoute('messages');
    }

    public function postMessage(Message $message)
    {
        $emManager = $this->getDoctrine()->getManager();

        $emManager->persist($message);
        $emManager->flush();
    }

}
