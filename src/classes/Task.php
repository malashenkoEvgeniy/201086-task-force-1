<?php

namespace app\classes;
use app\classes\actions\ActionStart;

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
    //блок свойств
    public $executorId;
    public $customerId;
    public $completionTime;
    public $status;
    public $initiatorId;//временное свойство, которое хранит id пользователя, соверщающего действие

    public function __construct(int $customerId)
    {

        $this->customerId = $customerId;
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
    public function start()
    {
        if (ActionStart::verificationRights($this)) {
            $this->status = self::STATUS_IN_WORK;
        }
        //Проверяем доступно ли действие старт, для текущего статуса и текущего пользователя
        //Если доступно-переводим в статус "в работе"
    }

    public function getAvailableActions($userId, $obj)
    {
        foreach ($obj->usersId as $key=>$id)
        {
            if($obj->status==Task::STATUS_NEW)
            {
                if($userId==$key and $id=='executor')
                {
                    return "Вам доступно действие: ".ActionRespond::inName();
                }
                if($userId==$key and $id=='customer' and $obj->customerId==$key)
                {
                    return "Вам доступно действие: ".ActionCancel::inName();
                }
            }
            if($obj->status==Task::STATUS_IN_WORK){
                if($userId==$key and $id=='executor' and $obj->executorId==$key)
                {
                    return "Вам доступно действие: ".ActionRefuse::inName();
                }
                if($userId==$key and $id=='customer' and $obj->customerId==$key)
                {
                    return "Вам доступно действие: ".ActionDone::inName();
                }
            }
            if($obj->status==Task::STATUS_FAILED){
                if($userId==$key and $id=='customer' and $obj->customerId==$key)
                {
                    return "Вам доступно действие: оставить отзыв";
                }
            }
        }
        return 'Вам не доступно ни какое действие!';
    }
}
