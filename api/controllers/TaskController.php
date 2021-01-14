<?php
namespace api\controllers;


use api\models\Task;
use yii\rest\ActiveController;

class TaskController extends ActiveController
{
  public $modelClass = Task::class;
}
