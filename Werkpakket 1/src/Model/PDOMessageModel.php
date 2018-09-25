<?php

namespace App\Model;


use Symfony\Component\HttpFoundation\JsonResponse;

class PDOMessageModel implements MessageModel
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findMessageByContentAndCategory($content, $category)
    {
        if (trim($content) == '' || trim($category) == '') {
            throw new \InvalidArgumentException();
        }

        $pdo = $this->connection->getPDO();

        $statement = $pdo->prepare('SELECT * FROM Messages WHERE content LIKE "%":content"%" and category like "%":category"%"');
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

    public function findMessageByContent($content)
    {
        $pdo = $this->connection->getPDO();

        $statement = $pdo->prepare('SELECT * FROM Messages WHERE content LIKE "%":content"%"');
        $statement->bindParam(':content', $content, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getAllMessages(){
        $statement = $this->connection->getPDO()->prepare('SELECT * FROM Messages');
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getMessage($id)
    {
        if ($id <= 0) {
            throw new \InvalidArgumentException();
        }

        $pdo = $this->connection->getPDO();

        $statement = $pdo->prepare('SELECT * FROM Messages WHERE id = :id');
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function addUpvote($id)
    {
        $upvotes = $this->getMessage($id)[0]['upvotes'] + 1;

        if ($id <= 0) {
            throw new \InvalidArgumentException();
        }

        $pdo = $this->connection->getPDO();

        $statement = $pdo->prepare('UPDATE Messages SET upvotes=:upvotes WHERE id=:id');
        $statement->bindParam(':upvotes', $upvotes, \PDO::PARAM_INT);
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function addDownvote($id)
    {
        $downvotes = $this->getMessage($id)[0]['downvotes'] + 1;

        if ($id <= 0) {
            throw new \InvalidArgumentException();
        }

        $pdo = $this->connection->getPDO();

        $statement = $pdo->prepare('UPDATE Messages SET downvotes=:downvotes WHERE id=:id');
        $statement->bindParam(':downvotes', $downvotes, \PDO::PARAM_INT);
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);

        return $statement->execute();
    }


}