<?php


namespace app\classes\actions;
use app\classes\exceptions\IncorrectActionStatusException;
use app\classes\exceptions\IncorrectInitiatorException;
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

    /**
     * @param Task $task
     * @throws IncorrectActionStatusException
     * @throws IncorrectInitiatorException
     */
    public static function verificationRights(Task $task)
    {
        if ($task->status !== Task::STATUS_IN_WORK) {
            throw new IncorrectActionStatusException("Статус задачи должен быть: ".Task::STATUS_IN_WORK );
        }
        if (!$task->customerId) {
            throw new IncorrectInitiatorException("Действие доступно только заказчику");
        }
        if ($task->executorId === $task->customerId) {
            throw new IncorrectInitiatorException("Заказчик и сполнитель не могут быть одним лицом!");
        }
        if ($task->initiatorId !== $task->customerId) {
            throw new IncorrectInitiatorException("Инициатор действия не заказчик");
        }
    }
}
