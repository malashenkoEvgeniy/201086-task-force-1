<?php

namespace app\classes;
use app\classes\actions\ActionCancel;
use app\classes\actions\ActionRespond;
use app\classes\actions\ActionStart;
use app\classes\actions\ActionRefuse;
use app\classes\actions\ActionDone;

class Task
{
    //блок констант статусов
    const STATUS_NEW = 'Новое';
    const STATUS_CANCELED = 'Отменено';
    const STATUS_IN_WORK = 'В работе';
    const STATUS_COMPLETED = 'Выполнено';
    const STATUS_FAILED = 'Провалено';

    //блок свойств
    public $executorId;
    public $customerId;
    public $completionTime;
    public $status;
    public $respond;

    public $initiatorId;//временное свойство, которое хранит id пользователя, соверщающего действие

    public function __construct(int $customerId, ?string $completionTime = null)
    {
        $this->customerId = $customerId;
        $this->status = self::STATUS_NEW;
        $this->completionTime = $completionTime;
    }

    //блок методов
    public function start()
    {
        if (ActionStart::verificationRights($this)) {
            $this->status = self::STATUS_IN_WORK;
        }
    }
    public function respond()
    {
        if (ActionRespond::verificationRights($this)) {
            $this->respond[] = $this->initiatorId;
        }
    }
    public function cancel()
    {
        if (ActionCancel::verificationRights($this)) {
            $this->status = self::STATUS_CANCELED;
        }
    }
    public function done()
    {
        if (ActionDone::verificationRights($this)) {
            $this->status = self::STATUS_COMPLETED;
        }
    }
    public function refuse()
    {
        if (ActionRefuse::verificationRights($this)) {
            $this->status = self::STATUS_FAILED;
        }
    }

    public function getAvailableActions()
    {
        $availableActions = [];
        if (ActionStart::verificationRights($this)) {
            $availableActions[] = ActionStart::getCode();
        }
        if (ActionCancel::verificationRights($this)) {
            $availableActions[] = ActionCancel::getCode();
        }
        if (ActionRespond::verificationRights($this)) {
            $availableActions[] = ActionRespond::getCode();
        }

        if (ActionDone::verificationRights($this)) {
            $availableActions[] = ActionDone::getCode();
        }
        if (ActionRefuse::verificationRights($this)) {
            $availableActions[] = ActionRefuse::getCode();
        }
        return $availableActions;
    }
}
