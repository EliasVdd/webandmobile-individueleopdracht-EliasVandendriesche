<?php

namespace App\Model;

interface MessageModel
{
    function getAllMessages();
    function findMessageByContent($content);
    function findMessageByContentAndCategory($content, $category);
    function getMessage($id);
    function addUpvote($id);
    function addDownvote($id);
}
