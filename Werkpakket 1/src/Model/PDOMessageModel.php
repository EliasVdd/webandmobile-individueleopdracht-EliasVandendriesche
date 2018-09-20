<?php

namespace App\Model;


class PDOMessageModel implements MessageModel
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getAllMessages(){
        $statement = $this->connection->getPDO()->prepare('SELECT * FROM Messages');
        $statement->execute();
        return $statement->fetchAll();
    }
}