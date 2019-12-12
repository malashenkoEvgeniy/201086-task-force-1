<?php


namespace app\classes\actions;

use app\classes\exceptions\IncorrectActionStatusException;
use app\classes\Task;


class ActionCancel extends AbstractActions
{
    const CODE = 'Отменить';
    public static function getName():string
    {
        return __CLASS__;
    }

    public static function getCode():string
    {
        return self::CODE;
    }

    /**
     * @param Task $task
     * @return bool
     * @throws IncorrectActionStatusException
     */
    public static function verificationRights(Task $task):bool
    {
        if ($task->status !== Task::STATUS_NEW) {
            throw new IncorrectActionStatusException("Статус задачи должен быть: ".Task::STATUS_NEW );
        }
        if (!$task->customerId) {
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
