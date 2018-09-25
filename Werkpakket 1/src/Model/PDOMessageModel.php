<?php

namespace App\Model;


class PDOMessageModel implements MessageModel
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findMessageByContentAndCategory($content, $category)
    {
        $pdo = $this->connection->getPDO();

        $statement = $pdo->prepare('SELECT * from Messages WHERE content like "%":content"%" and category like "%":category"%"');
        $statement->bindParam(':content', $content, \PDO::PARAM_STR);
        $statement->bindParam(':category', $category, \PDO::PARAM_STR);
        $statement->execute();

        /*$statement->bindColumn(1, $id, \PDO::PARAM_INT);
        $statement->bindColumn(2, $content, \PDO::PARAM_STR);
        $statement->bindColumn(3, $category, \PDO::PARAM_STR);
        $statement->bindColumn(4, $upVotes, \PDO::PARAM_INT);
        $statement->bindColumn(5, $downVotes, \PDO::PARAM_INT);*/

        return $statement->fetchAll();
    }

    public function getAllMessages(){
        $statement = $this->connection->getPDO()->prepare('SELECT * FROM Messages');
        $statement->execute();
        return $statement->fetchAll();
    }
}