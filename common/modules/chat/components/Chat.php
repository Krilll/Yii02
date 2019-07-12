<?php

namespace common\modules\chat\components;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use frontend\models\ChatUser;
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


        //$querystring = $conn->httpRequest->getUri()->getQuery();
        //parse_str($querystring,$hello);

        //print_r($hello);
    }

    public function onMessage(ConnectionInterface $from, $msg) {

        $query_task_id = $from->httpRequest->getUri()->getQuery();
        parse_str($query_task_id,$array_task_id);
        $task_id = $array_task_id['id_task'];

        $message = json_decode($msg);
        $text = $message->text;
        $user_id = $message->user_id;

        ChatUser::addMessage($task_id, $user_id, $text);
        //$text = $array_message['text'];
        //echo sprintf("\n");
        //print_r($array_message);
        //print_r("\n" .$user_id. "vvv" . "\n");



        //echo sprintf($hello . "\n");

       // $numRecv = count($this->clients) - 1;
        //echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
           // , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

      //  foreach ($this->clients as $client) {
            //if($client->taskId === $from->taskId) {
               // $client->send($msg);
           // }
            //if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
              //  $client->send($msg);
            //}
       // }
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