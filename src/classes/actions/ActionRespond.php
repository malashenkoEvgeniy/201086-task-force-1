<?php


namespace app\classes\actions;
use app\classes\Task;

class ActionRespond
{
    const CODE = 'Откликнуться';
    public static function getName():string
    {
        return __CLASS__;
    }

    public static function getCode():string
    {
        return self::CODE;
    }

    public static function verificationRights(Task $task):bool
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
        if ($task->initiatorId !== $task->executorId) {
            return false;
        }
        return true;
    }
}
