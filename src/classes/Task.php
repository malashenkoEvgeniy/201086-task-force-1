<?php

namespace app\classes;
use app\classes\actions\ActionCancel;
use app\classes\actions\ActionRespond;
use app\classes\actions\ActionStart;
use app\classes\actions\ActionRefuse;
use app\classes\actions\ActionDone;
use app\classes\exceptions\IncorrectActionStatusException;


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

    /**
     * @throws IncorrectActionStatusException
     */
    public function start()
    {
        ActionStart::verificationRights($this);
        $this->status = self::STATUS_IN_WORK;
    }

    /**
     * @throws IncorrectActionStatusException
     */
    public function respond()
    {
        ActionRespond::verificationRights($this);
        $this->respond[] = $this->initiatorId;
    }

    /**
     * @throws IncorrectActionStatusException
     */
    public function cancel()
    {
        ActionCancel::verificationRights($this);
        $this->status = self::STATUS_CANCELED;

    }

    /**
     * @throws IncorrectActionStatusException
     */
    public function done()
    {
        ActionDone::verificationRights($this);
        $this->status = self::STATUS_COMPLETED;
    }

    /**
     * @throws IncorrectActionStatusException
     */
    public function refuse()
    {
        ActionRefuse::verificationRights($this);
        $this->status = self::STATUS_FAILED;
    }

    /**
     * @return array
     * @throws IncorrectActionStatusException
     */
    public function getAvailableActions()
    {
        $availableActions = [];
        try {
            ActionStart::verificationRights($this);
            $availableActions[] = ActionStart::getCode();
        }catch (\Exception $e){}
        try {
            ActionCancel::verificationRights($this);
            $availableActions[] = ActionCancel::getCode();
        }catch (\Exception $e){}
        try{
            ActionRespond::verificationRights($this);
            $availableActions[] = ActionRespond::getCode();
        }catch (\Exception $e){}
        try{
            ActionDone::verificationRights($this);
            $availableActions[] = ActionDone::getCode();
        }catch (\Exception $e){}
        try {
            ActionRefuse::verificationRights($this);
            $availableActions[] = ActionRefuse::getCode();
        }catch (\Exception $e){}
        return $availableActions;
    }
}
