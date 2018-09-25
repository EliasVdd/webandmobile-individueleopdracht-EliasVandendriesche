<?php

namespace App\Model;


interface MessageModel
{
    function getAllMessages();
    public function findMessageByContentAndCategory($content, $category);
}