<?php

namespace frontend\classes;


use common\models\User;
use frontend\models\Task;

class AvailableActions
{
    public static function getActions($user, Task $task)
    {
        $userModel = User::find()->where(['id' => $user])->one();
        $availableActions = '';
        switch ($task->status) {
            case 0:
                if ($userModel->is_executor == 1) {
                    $availableActions = "respond";
                } else {
                    $availableActions = "cancel";
                }
                break;
            case 2:
                if ($userModel->is_executor == 1) {
                    $availableActions = "refuse";
                } else {
                    $availableActions = "done";
                }
                break;
        }
        return $availableActions;
    }
}
