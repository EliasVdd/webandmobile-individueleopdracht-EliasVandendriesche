<?php

namespace App\Model;


interface MessageModel
{
    public function findMessageByContentAndCategory($content, $category);
}