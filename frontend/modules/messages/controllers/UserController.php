<?php


namespace frontend\modules\messages\controllers;


use common\models\User;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
  public $modelClass = User::class;
}