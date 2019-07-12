<?php

namespace common\models;

use Yii;
use common\models\User;

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
        $id = (new \yii\db\Query())
            ->select(['id'])
            ->from('user')
            ->where(['username' => $name])
            ->one();

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
}
