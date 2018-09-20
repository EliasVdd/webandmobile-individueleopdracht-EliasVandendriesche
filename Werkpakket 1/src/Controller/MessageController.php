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
    public function getAllMessages(){

        $statusCode = 200;

        try{
            $messages = $this->messageModel->getAllMessages();
            if ($messages == null){
                $statusCode = 404;
            }
        } catch (\Exception $exception){
            $statusCode = 500;
        }

        return new JsonResponse($messages, $statusCode);
    }
}
