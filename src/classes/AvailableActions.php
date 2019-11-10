<?php

namespace app\classes;
class  AvailableActions
{

    //блок констант статусов
    const STATUS_NEW = 'Новое';
    const STATUS_CANCELED = 'Отменено';
    const STATUS_IN_WORK = 'В работе';
    const STATUS_COMPLETED = 'Выполнено';
    const STATUS_FAILED = 'Провалено';
    //блок констант действий
  //
    const ACTION_CREATE_NEW = 'создание новой';
    const ACTION_CANCEL = 'отменить';
    const ACTION_RESPOND = 'Откликнуться';
    const ACTION_DONE = 'Выполнено';
    const ACTION_REFUSE = 'Отказаться';

    //блок свойств
    private $userId;
    private $executorId;
    private $customerId;
    private $completionTime;
    private $status;

    public function __construct(int $customerId, string $completionTime)
    {
        $this->customerId = $customerId;
        $this->completionTime = $completionTime;
        $this->status = self::STATUS_NEW;
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
