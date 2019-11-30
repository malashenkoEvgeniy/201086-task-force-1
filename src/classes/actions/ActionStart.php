<?php


namespace app\classes\actions;

use app\classes\Task;

class ActionStart extends AbstractActions
{
    const CODE = 'Назначить испонителя';
    public static $customer = true;
    public static function getName()
    {
        return __CLASS__;
    }

    public static function getCode()
    {
       return self::CODE;
    }

    public static function verificationRights(Task $task)
    {
        if ($task->status !== Task::STATUS_NEW) {
            return false;
        }

        if (!$task->executorId) {
            return false;
        }

        if ($task->executorId === $task->customerId) {
            return false;
        }
        return true;
    }
}
