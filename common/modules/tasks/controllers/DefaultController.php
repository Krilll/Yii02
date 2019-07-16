<?php

namespace common\modules\tasks\controllers;

use common\models\Task;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;

/**
 * Default controller for the `tasks` module
 */
class DefaultController extends ActiveController
{
    public $modelClass = Task::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authentificator'] = [
        'class' => HttpBasicAuth::class,
         'auth' => function($username, $password){
           $user = User::findByUsername($username);
          if($user !== null && $user->validatePassword($password)){
              return $user;
         }
          return null;
          }
         ];
         return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    /**
     * Renders the index view for the module
     * http://y2aa-frontend.test/tasks/default/index
     * @return string
     */
    public function actionIndex()
    {
        //return $this->render('index');
        $query = Task::find();

        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
}
