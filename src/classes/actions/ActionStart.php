<?php


namespace app\classes\actions;

use app\classes\exceptions\UsersException;
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
            return false;
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
        try {
            if ($task->initiatorId !== $task->customerId and $task->initiatorId !== $task->executorId) {
                throw new UsersException('По этому заданию Вам не доступно ни каких действий');
            }
        } catch(UsersException $e) {
            echo $e->sameMethod() . ":" . $e->getMessage();
        }
        return true;
    }
}
