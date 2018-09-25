<?php

namespace App\Model;


interface MessageModel
{
    function getAllMessages();
    function findMessageByContentAndCategory($content, $category);
    function getMessage($id);
}