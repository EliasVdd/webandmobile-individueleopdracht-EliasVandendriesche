<?php

namespace App\Controller;

use App\Model\Connection;
use App\Model\ReactionModel;
use App\Model\PDOReactionModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReactionController extends AbstractController
{
    private $reactionModel;
    
    public function __construct(ReactionModel $reactionModel)
    {
        $this->reactionModel = $reactionModel;
    }
    
    /**
    * @Route("/reaction/{id}/{content}", methods={"POST"}, name="postReactionByMessageId")
    */
    public function postReactionByMessageId($id, $content)
    {
        $statuscode = 200;
        $reactions = null;
        
        try
        {
            $reactions = $this->reactionModel->postReactionByMessageId($id, $content);
            if($reactions == null) {
                $statuscode = 404;
            }
        } catch (\InvalidArgumentException $exception)
        {
            $statuscode = 400;
        } catch (\PDOException $ex) 
        {
            $statuscode = 500;
        }
        
        return new JsonResponse($content);
    }
}