<?php

namespace App\Model;

interface ReactionModel
{
    function postReactionByMessageId($id, $content);
}