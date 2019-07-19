<?php

namespace common\modules\chat\controllers;

use Yii;
use yii\console\Controller;
use Ratchet\Server\IoServer;
use common\modules\chat\components\Chat;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
//use yii\data\ActiveDataProvider;
//use yii\filters\auth\HttpBasicAuth;
//use yii\rest\ActiveController;

include 'vendor/autoload.php';

/**
 * Default controller for the `chat` module
 */
class DefaultController extends Controller
{


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Chat()
                )
            ),
            Yii::$app->params['chat.port']
        );

        //$html = Yii::$app->request->absoluteUrl;
        // $html;

        echo "Hello from Server!".PHP_EOL;
//8080
        $server->run();

    }
}
