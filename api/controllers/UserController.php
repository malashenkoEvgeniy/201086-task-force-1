<?php


namespace api\controllers;


use api\models\User;

class UserController extends BaseApiController
{
    public $modelClass = User::class;
}