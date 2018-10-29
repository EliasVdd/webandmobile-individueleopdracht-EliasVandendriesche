<?php

namespace App\Controller;

use App\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Message;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;

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
        $messages = $this->getDoctrine()
            ->getRepository(Message::class)
            ->findAll();

        return $this->render('message/index.html.twig', [
            'messages' => $messages
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

    public function postMessage(Message $message)
    {
        $emManager = $this->getDoctrine()->getManager();

        $emManager->persist($message);
        $emManager->flush();
    }

}
