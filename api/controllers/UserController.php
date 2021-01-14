<?php
namespace api\controllers;


use api\models\User;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
  public $modelClass = User::class;
}
