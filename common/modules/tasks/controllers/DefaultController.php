<?php

namespace common\modules\tasks\controllers;

use yii\web\Controller;
use common\models\Task;
use yii\data\ActiveDataProvider;

/**
 * Default controller for the `tasks` module
 */
class DefaultController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        //$behaviors['authentificator'] = [
        //'class' => HttpBasicAuth::class,
        // 'auth' => function($username, $password){
        //   $user = User::findByUsername($username);
        ///  if($user !== null && $user->validatePassword($password)){
        //      return $user;
        // }
        //  return null;
        //  }
        // ];
        // retu
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        $query = Task::find();

        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}
