<?php

namespace App\Model;

use PHPUnit\Framework\TestCase;

class PDOMessageModelTest extends TestCase
{
    private $connection;

    public function setUp()
    {
        $this->connection = new Connection('sqlite::memory:');
        $this->connection->getPDO()->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION
        );
        $this->connection->getPDO()->exec('CREATE TABLE Messages (
          `id` int(11) NOT NULL,
          `content` varchar(255) NOT NULL,
          `category` varchar(255) NOT NULL,
          `upvotes` int(11) NOT NULL,
          `downvotes` int(11) NOT NULL,
          PRIMARY KEY (id)
        )');

        $messages = $this->providerMessages();
        foreach ($messages as $message) {
            $this->connection->getPDO()->exec("INSERT INTO Messages (id, content, category, upvotes, downvotes) VALUES ("
                . $message['id'] . ", '" . $message['content'] . "', '" . $message['category'] . "', "
                . $message['upvotes'] . ", " . $message['downvotes'] . ");");
        }
    }

    public function tearDown()
    {
        $this->connection = null;
    }

    public function providerMessages()
    {
        return [[
            'id'=>1,
            'content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sit.',
            'category'=>'Hardware',
            'upvotes'=>5,
            'downvotes'=>2
        ],
        [
            'id'=>2,
            'content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sit.',
            'category'=>'Angular',
            'upvotes'=>10,
            'downvotes'=>9
        ],
        [
            'id'=>3,
            'content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sit.',
            'category'=>'React',
            'upvotes'=>2,
            'downvotes'=>8
        ]];
    }

    public function testGetAllMessages_messagesInDatabase_ArrayMessages()
    {
        $messageModel = new PDOMessageModel($this->connection);
        $actualMessages = $messageModel->getAllMessages();
        $expectedMessages = $this->providerMessages();
        $this->assertEquals('array', gettype($actualMessages));
        $this->assertEquals(count($expectedMessages), count($actualMessages));
        foreach ($actualMessages as  $actualMessage) {
            $this->assertContains($actualMessage, $actualMessages);
        }
    }
}