<?php


namespace console\controllers;
use common\models\Telegram;
use SonkoDmitry\Yii\TelegramBot\Component;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\Update;
use yii\console\Controller;

class TelegramController extends Controller
{
    /** @var  Component */
    private $bot;
    private $offset = 0;

    public function init()
    {
        parent::init();
        $this->bot = \Yii::$app->bot;
    }

    public function actionIndex()
    {
        $updates = $this->bot->getUpdates($this->getOffset() + 1);
        $updCount = count($updates);
        if($updCount > 0){
            echo "Новых сообщений " . $updCount . PHP_EOL;
            foreach ($updates as $update){
                $this->updateOffset($update);
                $this->processCommand($update->getMessage());
            }
        }else{
            echo "Новых сообщений нет" . PHP_EOL;
        }
    }

    private function getOffset()
    {
        $max = Telegram::find()
            ->select('id')
            ->max('id');
        if($max > 0){
            $this->offset = $max;
        }
        return $this->offset;
    }

    private function updateOffset(Update $update)
    {
        $model = new Telegram([
            'id' => $update->getUpdateId(),
            'timestamp_offset' => date("Y-m-d H:i:s")
        ]);
        $model->save();
    }

    private function processCommand(Message $message){
        $params = explode(" ",  $message->getText());
        $command = $params[0];
        $response = 'Unknown command';
        switch($command){
            case "/help":
                $response = "Доступные команды: \n";
                $response .= "/help - вывод списка комманд\n";
                $response .= "/project_create #project_name# - создание нового проекта\n";
                //$response .= "/task_create ##task_name## ##responcible## ##project## -созданпие таска\n";
                $response .= "/sp_create  - подписка на оповещения о новых проектах\n";
                break;
            case "/project_create":
                $response = "Вы подписаны на оповещение о новых проектах: \n";
                break;
            case "/sp_create":
                $response = "Вы подписаны на оповещение о новых проектах: \n";
                break;
        }
        $this->bot->sendMessage($message->getFrom()->getId(), $response);
    }

}