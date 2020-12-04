<?php


namespace modules\api\controllers;


use modules\api\models\Messages;
use yii\data\ActiveDataProvider;

class MessagesController extends BaseApiController
{
    public $modelClass = Messages::class;

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        //unset($actions['create']);
        return $actions;
    }

    public function actionIndex($id = 1)
    {
        return new ActiveDataProvider([
          'query' => Messages::find()->where(['task_id' => $id]),
          'pagination' => [
            'pageSize' => 5
          ]
        ]);
    }


}