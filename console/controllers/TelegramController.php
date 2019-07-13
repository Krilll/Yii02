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
    private $num_projects = 0;

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
        $params = explode(",",  $message->getText());
        $command = $params[0];
        $response = 'Unknown command';
        switch($command){
            case "/help":
                $response = "Доступные команды: \n";
                $response .= "/help - вывод списка комманд\n";
                $response .= "/project_create,#project_title#, #project_description#, #project_creator#\n - создание нового проекта\n";
                //$response .= "/task_create ##task_name## ##responcible## ##project## -созданпие таска\n";
                $response .= "/sp_create  - подписка на оповещения о новых проектах\n";
                break;

            case "/project_create":

                if(empty($params[1]) || empty($params[2]) || empty($params[3])) {
                    $response = "Введите все параметры для создания задачи\n #project_title# #project_description# #project_creator#\n";
                    break;
                }

                $title = $params[1];
                $description = $params[2];
                $creator = $params[3];

                $user_id = Telegram::checkUser($creator);
                if(empty($user_id)) {
                    $response = "Вашего логина нет в базе данных\n";
                    break;
                }

                $answer = Telegram::createProject($title, $description, $user_id['id']);
                if(!$answer) {
                    $response = "Создание вашего проекта завершилось крахом.";
                    break;
                }
                $response = "Создание вашего проекта прошло успешно!";
                break;

            case "/sp_create":
                $user_id = $message->getFrom()->getId();

                $answer = Telegram::createSubscribeProjects($user_id);
                if(!$answer) {
                    $response = "Подписка на оповещения о новых проектах не сработала.";
                    break;
                }

                $response = "Вы подписаны на оповещения о новых проектах!";
                break;
        }
        $this->bot->sendMessage($message->getFrom()->getId(), $response);
    }


    public function actionProjects()
    {
        $new_num_projects =  Telegram::checkProjects();

        if($this->num_projects < $new_num_projects) {
          //$num = $new_num_projects - $this->num_projects;
          $subscribes = Telegram::checkSubscribeProjects();

           // $id = Project::find()
               // ->select('id')
                //->max('id');

          if(!empty($subscribes)) {
              foreach ($subscribes as $subscribe){
                  $response = "Создан проект" ;
              }
          }

          $this->num_projects = $new_num_projects;
        } else {
            echo "Новых проектов нет" . PHP_EOL;
        }
    }
}