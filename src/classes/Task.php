<?php

namespace app\classes;
class Task
{
    //блок констант статусов
    const STATUS_NEW = 'Новое';
    const STATUS_CANCELED = 'Отменено';
    const STATUS_IN_WORK = 'В работе';
    const STATUS_COMPLETED = 'Выполнено';
    const STATUS_FAILED = 'Провалено';
    //блок констант действий
    const ACTION_CREATE_NEW = 'создание новой';
    const ACTION_CANCEL = 'отменить';
    const ACTION_RESPOND = 'Откликнуться';
    const ACTION_DONE = 'Выполнено';
    const ACTION_REFUSE = 'Отказаться';
    const ACTION_APPOINT_AN_EXECUTOR = 'Назначить испонителя';
    //блок свойств
    public $executorId;
    public $customerId;
    public $completionTime;
    public $status;
    public $usersId;

    public function __construct(int $customerId, array $usersId)
    {
        $this->usersId = $usersId;
        $this->customerId = $customerId;
        $this->status = self::STATUS_NEW;
        $this->respond = [];
    }

    //блок методов
    public function getNextStatus($action)
    {
        switch ($action) {
            case self::ACTION_CREATE_NEW:
                return self::STATUS_NEW;
            case self::ACTION_CANCEL:
                return self::STATUS_CANCELED;
            case self::ACTION_RESPOND:
                return self::STATUS_IN_WORK;
            case self::ACTION_DONE:
                return self::STATUS_COMPLETED;
            case self::ACTION_REFUSE:
                return self::STATUS_FAILED;
        }
        return null;
    }
}
