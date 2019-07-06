<?php
namespace server;

use Ratchet\Server\IoServer;
//use Chat;
use Yii;
//use Chat;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use frontend\assets\ChatAsset;

include "Chat.php";
include "vendor/autoload.php";


$server = IoServer::factory(
    new Chat(), 8080
    //Yii::$app->params['chat.port']
);

echo "Hello from Server!".PHP_EOL;

$server->run();
