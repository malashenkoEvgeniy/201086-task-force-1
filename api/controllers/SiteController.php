<?php

namespace api\controllers;


use common\models\User;
use yii\rest\ActiveController;

/**
 * Site controller
 */
class SiteController extends ActiveController
{
    public $modelClass = User::class;
}
