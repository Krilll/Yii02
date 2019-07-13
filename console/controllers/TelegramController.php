<?php


namespace console\controllers;
use common\models\Telegram;
use common\models\TelegramSubscribe;
use common\models\Project;
use common\models\User;
use common\models\MaxItems;
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
        $params = explode(", ",  $message->getText());
        $command = $params[0];
        $response = "Unknown command.";

        if($command === "/help") {
            $response = Telegram::getHelpInformation();
        } else if ($command === "/project_create") {
            if(empty($params[1]) || empty($params[2]) || empty($params[3])) {
                $response = "Введите все параметры для создания задачи\n project_title, project_description, project_creator\n";
            } else {
                $title = $params[1];
                $description = $params[2];
                $creator = $params[3];

                $user_id = User::find()
                    ->select('id')
                    ->where(['username' => $creator])
                    ->one();

                if(empty($user_id['id'])) {
                    $response = "Вашего логина нет в базе данных\n";
                } else {

                    /*$model = new Project([
                        'title' => $title,
                        'description' => $description,
                        'creator_id'=> $user_id['id'],
                    ]);*/

                    $model = Telegram::createProject($title, $description, $user_id['id']);

                    if($model) {
                        $response = "Создание вашего проекта прошло успешно!";
                    } else {
                        $response = "Создание вашего проекта завершилось крахом.";
                    }
                }
            }
        } else if ($command === "/sp_create") {
            $user_id = $message->getFrom()->getId();

            $model = new TelegramSubscribe([
                'thing'=> TelegramSubscribe::CONST_PROJECT_CREATE,
                'subs_telegram'=> $user_id,
            ]);

            if($model->save()) {
                $response = "Вы подписаны на оповещения о новых проектах!";
            } else {
                $response = "Подписка на оповещения о новых проектах не сработала.";
            }
        }
        $this->bot->sendMessage($message->getFrom()->getId(), $response);
    }


    public function actionProjects()
    {
        $response = "";
        $num_projects = MaxItems::find()
            ->select('max_id')
            ->where(['title' => TelegramSubscribe::CONST_PROJECT_CREATE])
            ->one();

        $projects = Project::find()
            ->select('id')
            ->max('id');

        if($projects > $num_projects['max_id']){
            $num = $projects - $num_projects['max_id'];
            $title =  Project::find()
                ->select('title')
                ->orderBy(['id' => SORT_DESC])
                ->limit($num)
                ->all();
            foreach ($title as $name){
                $response .= "Создан новый проект " . $name['title'] . "!\n";
            }

            MaxItems::updateAll(['max_id' => $projects],
                ['title' => TelegramSubscribe::CONST_PROJECT_CREATE]);

            $response .= "Новых проектов: " . ($num) . PHP_EOL;
        } else {
            $response .= "Новых проектов нет" . PHP_EOL;
        }

        $people = TelegramSubscribe::find()
            ->select(['subs_telegram'])
            ->where(['thing' => 'projects'])
            ->all();

        if($people){
            foreach ($people as $man){
                $this->bot->sendMessage($man['subs_telegram'], $response);
            }
        }
        echo $response;
    }
}