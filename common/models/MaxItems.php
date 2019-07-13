<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "max_items".
 *
 * @property string $title
 * @property int $max_id
 */
class MaxItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'max_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'max_id'], 'required'],
            [['title'], 'string'],
            [['max_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'max_id' => 'Max ID',
        ];
    }
}
