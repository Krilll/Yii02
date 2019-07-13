<?php

namespace common\models;

use Yii;
use common\models\User;
use common\models\Project;


/**
 * This is the model class for table "telegram_offset".
 *
 * @property int $id
 * @property string $timestamp_offset
 */
class Telegram extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telegram';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['timestamp_offset'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'timestamp_offset' => 'Timestamp Offset',
        ];
    }

    /**
     * write help information
     * @return string
     * */
    public function getHelpInformation() {
        $response = "Доступные команды: \n";
        $response .= "/help - вывод списка комманд\n";
        $response .= "/project_create, project_title, project_description#, project_creator\n - создание нового проекта\n";
        //$response .= "/task_create ##task_name## ##responcible## ##project## -созданпие таска\n";
        $response .= "/sp_create - подписка на оповещения о новых проектах\n";

        return $response;
    }


    /**
     * @param string $title
     * @param string $description
     * @param int $user_id
     * @throws
     * @return string
     */
    public function createProject($title, $description, $user_id) {
        Yii::$app->db->createCommand()
            ->insert('project',
                [
                    'title'=> $title,
                    'description'=> $description,
                    'creator_id'=> $user_id,
                ])->execute();

        return true;
    }
}
