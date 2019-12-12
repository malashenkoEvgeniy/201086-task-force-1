<?php


namespace app\classes\actions;
use app\classes\exceptions\IncorrectActionStatusException;
use app\classes\Task;

class ActionStart extends AbstractActions
{
    const CODE = 'Назначить';
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
            throw new IncorrectActionStatusException("Статус задачи должен быть: ".Task::STATUS_NEW );
        }
        if (!$task->executorId) {
            return false;
        }
        if ($task->executorId === $task->customerId) {
            return false;
        }
        if ($task->initiatorId !== $task->customerId) {
            return false;
        }
        return true;
    }
}
