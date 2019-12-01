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
    public $availableActions;
    public $initiatorId;//временное свойство, которое хранит id пользователя, соверщающего действие

    public function __construct(int $customerId)
    {
        $this->customerId = $customerId;
        $this->status = self::STATUS_NEW;
        $this->executorId = '';
        $this->completionTime = '21.12.2022';
    }

    //блок методов
    public function newTask()
    {
        if ($this->initiatorId == $this->customerId) {
            $this->availableActions[] = ActionStart::getCode();
            $this->availableActions[] = ActionCancel::getCode();
        } else {
            $this->availableActions[] = ActionRespond::getCode();
        }
    }
    public function start()
    {
        if (ActionStart::verificationRights($this)) {
            $this->status = self::STATUS_IN_WORK;
            $this->availableActions[]= ActionDone::getCode();
            //$this->availableActions[]= ActionRefuse::getCode();
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
        switch ($this->status) {
            case Task::STATUS_NEW:
                $this->newTask();
                return $this->availableActions;
            case Task::STATUS_IN_WORK:
                if (ActionRefuse::verificationRights($this)) {
                    $this->availableActions[] =  ActionRefuse::getCode();
                }
                return $this->availableActions;
        }
    }
}
