<?php

namespace common\modules\chat\components;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use frontend\models\ChatUser;
use common\models\User;
use yii\db\Query;
use Yii;

class Chat implements MessageComponentInterface
{
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {

        $query_task_id = $from->httpRequest->getUri()->getQuery();
        parse_str($query_task_id,$array_task_id);
        $task_id = $array_task_id['id_task'];

        $message = json_decode($msg);
        $text = $message->text;
        $user_id = $message->user_id;
        $user_name = User::findById($user_id);
        $message->username = $user_name->username;

        $msg = json_encode($message);

        $array_message = ChatUser::addMessage($task_id, $user_id, $text);
        print_r($array_message);


        foreach ($this->clients as $client) {
            $client_query_task_id = $client->httpRequest->getUri()->getQuery();
            parse_str($client_query_task_id,$client_array_task_id);
            $client_task_id = $client_array_task_id['id_task'];

            if($client_task_id === $task_id) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}