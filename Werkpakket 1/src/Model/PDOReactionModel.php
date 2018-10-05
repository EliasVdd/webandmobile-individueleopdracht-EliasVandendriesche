<?php

namespace App\Model;

class PDOReactionModel implements ReactionModel
{
    private $connection;
    
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
    
    public function postReactionByMessageId($id, $content)
    {
        $pdo = $this->connection->getPDO();
        
        $token = uniqid('saltvoorextrapunten'.$id, true);
        
        $statement = $pdo->prepare('INSERT INTO Reactions (messageId, content, reactionToken) VALUES (:id, :content, :token)');
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);
        $statement->bindParam(':content', $content, \PDO::PARAM_STR);
        $statement->bindParam(':token', $token, \PDO::PARAM_STR);
        
        $statement->execute();

        return $token;
    }
}
