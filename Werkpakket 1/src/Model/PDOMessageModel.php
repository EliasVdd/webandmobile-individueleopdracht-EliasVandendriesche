<?php

namespace App\Model;


class PDOMessageModel implements MessageModel
{

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}