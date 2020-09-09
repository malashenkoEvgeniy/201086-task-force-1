<?php


namespace console\controllers;


use yii\rbac\Rule;

class CustomerRule extends Rule
{
    public $name = 'isCustomer';

    public function execute($user, $item, $params)
    {
        return isset($params['task']) ? $params['task']->createdBy == $user : false;
    }
}