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
     * @param string $name Username
     * @return \yii\db\ActiveQuery
     */
    public function checkUser($name) {
        $id = User::find()
            ->select('id')
            ->where(['username' => $name]);
        /*$id = (new \yii\db\Query())
            ->select(['id'])
            ->from('user')
            ->where(['username' => $name])
            ->one();*/

        return $id;
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

    /**
     * @param int $user_id Telegram id
     * @throws
     * @return string
     */
    public function createSubscribeProjects($user_id) {
        Yii::$app->db->createCommand()
            ->insert('telegram_subscribe',
                [
                    'thing'=> 'projects',
                    'subs_telegram'=> $user_id,
                ])->execute();

        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function checkProjects() {
        $id = Project::find()
            ->select('id')
            ->max('id');

        return $id;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function checkSubscribeProjects() {
        $id = (new \yii\db\Query())
            ->select(['subs_telegram'])
            ->from('telegram_subscribe')
            ->where(['thing' => 'projects'])
            ->orWhere(['thing' => 'all'])
            ->all();

        return $id;
    }
}
