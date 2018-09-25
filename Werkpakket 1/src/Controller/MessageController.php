<?php

namespace App\Controller;

use App\Model\Connection;
use App\Model\MessageModel;
use App\Model\PDOMessageModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    private $messageModel;

    public function __construct(MessageModel $messageModel)
    {
        $this->messageModel = $messageModel;
    }

    /**
     * @Route("/message", name="message")
     */
    public function getAllMessages()
    {
        $statusCode = 200;
        $messages = null;
        try {
            $messages = $this->messageModel->getAllMessages();
            if ($messages == null) {
                $statusCode = 404;
            }
        } catch (\Exception $exception) {
            $statusCode = 500;
        }
        return new JsonResponse($messages, $statusCode);
    }

    /**
     * @Route("/message/{id}", methods={"GET"}, name="getMessageById")
     */
    public function getMessage($id)
    {
        $statuscode = 200;

        $message = null;
        try {
            $message = $this->messageModel->getMessage($id);
            if ($message == null) {
                $statuscode = 404;
            }
        } catch (\InvalidArgumentException $exception) {
            $statuscode = 400;
        } catch (\PDOException $exception) {
            $statuscode = 500;
        }

        return new JsonResponse($message, $statuscode);
    }

    /**
     * @Route("/message/{content}/{category}"), methods={"GET"}, name="getMessageByContentAndCategory")
     */
    public function findMessageByContentAndCategory($content, $category)
    {
        $statuscode = 200;

        $messages = null;
        try {
            $messages = $this->messageModel->findMessageByContentAndCategory($content, $category);
            if ($messages == null) {
                $statuscode = 404;
            }
        } catch (\InvalidArgumentException $exception) {
            $statuscode = 400;
        } catch (\PDOException $exception) {
            $statuscode = 500;
        }

        return new JsonResponse($messages, $statuscode);
    }

    /**
     * @Route("/message/{id}"), methods={"PUT"}, name="addUpvote")
     */
    public function addUpvote($id)
    {
        $statuscode = 200;

        $message = null;
        try {
            $message = $this->messageModel->addUpvote($id);
            if ($message == null) {
                $statuscode = 404;
            }
        } catch (\InvalidArgumentException $exception) {
            $statuscode = 400;
        } catch (\PDOException $exception) {
            $statuscode = 500;
        }

        return new JsonResponse($message, $statuscode);
    }
}
