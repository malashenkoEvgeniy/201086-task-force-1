<?php


namespace app\classes\actions;

use app\classes\Task;

class ActionStart extends AbstractActions
{
    const CODE = Task::ACTION_RESPOND;
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
        if ($task->initiator_id !== $task->cutomer_id) {
            return false;
        }
        return true;
    }
}
