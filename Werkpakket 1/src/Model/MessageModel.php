<?php

namespace App\Model;


interface MessageModel
{
    function getAllMessages();
    function findMessageByContent($content);
    function findMessageByContentAndCategory($content, $category);
    function getMessage($id);
}