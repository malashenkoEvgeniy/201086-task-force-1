<?php


namespace api\controllers;

use api\models\Messages;
use yii\rest\ActiveController;

class MessagesController extends BaseApiController
{
  public $modelClass = Messages::class;


}