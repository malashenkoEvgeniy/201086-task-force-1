<?php


namespace frontend\modules\api\controllers;


use frontend\models\ChatMessages;

class MessagesController extends BaseApiController
{
    public $modelClass = ChatMessages::class;
}