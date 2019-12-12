<?php


namespace app\classes\actions;
use app\classes\exceptions\IncorrectActionStatusException;
use app\classes\Task;

class ActionDone extends AbstractActions
{
    const CODE = 'Выполнено';
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
        if ($task->status !== Task::STATUS_IN_WORK) {
            throw new IncorrectActionStatusException("Статус задачи должен быть: ".Task::STATUS_IN_WORK );
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
