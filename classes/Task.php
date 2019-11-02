<?php




class Task
{
  
  //блок констант статусов
  const STATUS_NEW = 'Новое';
  const STATUS_CANCELED = 'Отменено';
  const STATUS_INWORK = 'В работе';
  const STATUS_COMPLETED = 'Выполнено';
  const STATUS_FAILED = 'Провалено';
  //блок констант действий
  const ACTION_CREATE_NEW = 'создание новой';
  const ACTION_CANCEL = 'отменить';
  const ACTION_RESPOND = 'Откликнуться';
  const ACTION_DONE = 'Выполнено';
  const ACTION_REFUSE = 'Отказаться';
    //блок констант пользователей
  const ROLES = ['anonymous' => 'Анонимные пользователи',
                 'executor' => 'Исполнитель',
                 'customer' => 'Заказчик'];

    //блок свойств
  private $idExecutor, $idCustomer, $completionDate, $activeStatus;
    //блок методов
   function getNextStatus($action){
     $list = '';
     switch ($action){
       case self::ACTION_CREATE_NEW: 
            $list .= self::STATUS_NEW;
            break;
       case self::ACTION_CANCEL: 
            $list .= self::STATUS_CANCELED;
            break;
       case self::ACTION_RESPOND: 
            $list .= self::STATUS_INWORK;
            break;
       case self::ACTION_DONE: 
            $list .= self::STATUS_COMPLETED;
            break;
        case self::ACTION_REFUSE: 
            $list .= self::STATUS_FAILED;
            break; 
     }
     return $list;
  }  
}
