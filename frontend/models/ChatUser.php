<?php

namespace frontend\models;

use Yii;
use common\models\Task;
use common\models\User;
//use yii;
/**
 * This is the model class for table "chat_user".
 **/
 //@property int $id
  //@property int $task_id
  //@property int $user_id
  //@property string $text
  //@property string $time_date
 /**
 * @property Task $task
 * @property User $user
 */
class ChatUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'user_id', 'text'], 'required'],
            [['task_id', 'user_id'], 'integer'],
            [['text'], 'string'],
            [['time_date'], 'safe'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'user_id' => 'User ID',
            'text' => 'Text',
            'time_date' => 'Time Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @param integer $id Task id
     * @return \yii\db\ActiveQuery
     */
    public function getTasks($id)
    {
        $name = (new \yii\db\Query())
            ->select(['chat_user.text', 'user.username'])
            ->from('chat_user')
            ->innerJoin('user')
            ->where(['chat_user.task_id' => $id]) ->all();

        return json_encode($name);
    }

    /**
     * @param integer $task_id Task id
     * @param integer $user_id User id
     * @param string $text Message
     * @return string
     */
    public function addMessage($task_id, $user_id, $text)
    {
        $chat = new ChatUser();
        $chat->task_id = $task_id;
        $chat->user_id = $user_id;
        $chat->text = $text;

        if($chat->save()) {
            return 'Message save';
        } else {
            return 'Message not save';
        }
    }

    /**
     * @param integer $id Task id
     * @return integer $id Task id
     */
    public function getId($id)
    {
        return $id;
    }
}
