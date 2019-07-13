<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "telegram_subscribe".
 *
 * @property int $id
 * @property string $thing
 * @property int $subs_telegram
 */
class TelegramSubscribe extends \yii\db\ActiveRecord
{

    const CONST_PROJECT_CREATE = 'projects';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telegram_subscribe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['thing'], 'string'],
            [['subs_telegram'], 'required'],
            [['subs_telegram'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'thing' => 'Thing',
            'subs_telegram' => 'Subs Telegram',
        ];
    }
}
