<?php

namespace app\classes;

class  AvailableActions
{
    public static $task;
    public static function getNextObj($userId,  $usersId, $action)
    {
        switch ($action)
        {
            case ActionCreateNew::name():
                 if(ActionCreateNew::verificationOfRights($userId, $usersId) !== false)
                 {
                     return self::$task = new Task($userId, $usersId);
                 }
            case ActionCancel::name():
                if(ActionCancel::verificationOfRights($userId, $usersId) !== false)
                {
                    self::$task->status = Task::STATUS_CANCELED;
                    return self::$task;
                }
            case  ActionRespond::name():
                if(ActionRespond::verificationOfRights($userId, $usersId) !== false)
                {
                    array_push(self::$task->respond, ActionRespond::verificationOfRights($userId, $usersId));
                    return self::$task;
                }
            case  ActionAppointAnExecutor::name():
                if(ActionAppointAnExecutor::verificationOfRights($userId, $usersId) !== 'false')
                {
                    foreach ($usersId as $key=>$user)
                    {
                        if ((count(self::$task->respond) > 0) and (self::$task->customerId == $key))
                        {
                            foreach (self::$task->respond as $respond)
                            {
                                if ($respond) {
                                    self::$task->executorId = $respond;
                                    self::$task->status = Task::STATUS_IN_WORK;
                                    return self::$task;
                                }
                            }
                        }
                    }
                }
            case ActionRefuse::name():
                if(ActionRefuse::verificationOfRights($userId, $usersId))
                {
                    foreach ($usersId as $key=>$user)
                    {
                        if (self::$task->executorId == $key)
                        {
                            self::$task->status = Task::STATUS_FAILED;
                            return self::$task;
                        }
                    }

                }
            case ActionDone::name():
                if(ActionDone::verificationOfRights($userId, $usersId))
                {
                    foreach ($usersId as $key=>$user)
                    {
                        if (self::$task->customerId == $key)
                        {
                            self::$task->status = Task::STATUS_COMPLETED;
                            return self::$task;
                        }
                    }

                }
        }
        return null;
    }
    public static function actions($userId, $obj)
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

