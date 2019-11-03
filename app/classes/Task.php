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
  private $idExecutor;
  private $idCustomer;
  private $completionDate;
  private $activeStatus;
    //блок методов
   function getNextStatus($action){
     switch ($action){
       case self::ACTION_CREATE_NEW: 
            return self::STATUS_NEW;
            break;
       case self::ACTION_CANCEL: 
            return self::STATUS_CANCELED;
            break;
       case self::ACTION_RESPOND: 
            return self::STATUS_INWORK;
            break;
       case self::ACTION_DONE: 
            return self::STATUS_COMPLETED;
            break;
        case self::ACTION_REFUSE: 
            return self::STATUS_FAILED;
            break; 
     }
     return null;
  }  
}
