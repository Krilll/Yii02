<?php

namespace frontend\models\query;

/**
 * This is the ActiveQuery class for [[\frontend\models\Task]].
 *
 * @see \frontend\models\Task
 */
class TaskQuery extends \yii\db\ActiveQuery
{
    public function byCreator($userId)
    {
        return $this->andWhere(['creator_id' => $userId]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Task[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Task|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
