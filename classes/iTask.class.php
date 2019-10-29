<?php

interface iTask
{
    /**
     *	Выводит список действий
     *
     *	@param string $activeStatus - активный статус, $completionDate- время выполнения задания, $id-id пользователя, $roleExecutor-заказчик или исполнитель
     *
     *	@return array  - id заказчика, активный статус, доступное действия, возможен переход в статус
     
     */
    public function getActions($activeStatus, $completionDate, $id, $roleExecutor);
   
}

?>