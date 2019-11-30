<?php

namespace app\classes;
use app\classes\actions\ActionCancel;
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
    public $initiatorId;//временное свойство, которое хранит id пользователя, соверщающего действие

    public function __construct(int $customerId)
    {
        $this->customerId = $customerId;
        $this->status = self::STATUS_NEW;
        $this->executorId = '';
    }

    //блок методов
    public function start()
    {
        if (ActionStart::verificationRights($this)) {
            $this->status = self::STATUS_IN_WORK;
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

    public function getAvailableActions(int $userId)
    {
        $availableActions = [];
        if( $userId === $this->customerId) {
            switch ($this->status) {
                case Task::STATUS_NEW:
                    $availableActions[] = ActionCancel::getCode();
                    $availableActions[] = ActionStart::getCode();
                    return $availableActions;
                case Task::STATUS_IN_WORK:
                    $availableActions[] =  ActionDone::getCode();
                    return $availableActions;
            }
        }
        if( $userId === $this->executorId) {
            switch ($this->status) {
                case Task::STATUS_NEW:
                    $availableActions[] = ActionStart::getCode();
                    return $availableActions;
                case Task::STATUS_IN_WORK:
                    $availableActions[] =  ActionRefuse::getCode();
                    return $availableActions;
            }
        }

    }
}
