<?php
function __autoload($name) {
  include "$name.class.php";
}

class Task implements iTask
{
  const STATUSES = [ 'pending' => 'В ожидании',
                    'newTask' => 'Новое',
                    'canceled' => 'Отменено',
                    'onСheck' => 'На проверке',
                    'inWork' => 'В работе',
                    'completed' => 'Выполнено', 
                    'failed' => 'Провалено'];
  const ROLES = ['anonymous' => 'Анонимные пользователи',
                 'executor' => 'Исполнитель',
                 'customer' => 'Заказчик'];
  const ACTIONS = ['newTask' => 'Создать новое задание',
                   'allowToTask' => 'Принять',
                   'done' => 'Выполнено',
                   'canselTask' => 'Отменить', 
                   'respond' => 'Откликнуться',
                   'refuse' => 'Отказаться',
                   'forRevision'=> 'На доработку'];
  
  private $idExecutor, $idCustomer, $completionDate, $activeStatus;
  function __construct($activeStatus, $completionDate, $id, $roleExecutor = 'false') {
    $this->activeStatus = $activeStatus;
    if($this->isTimeActuale($completionDate)){
      $this->completionDate = $completionDate; 
    } else {
      $this->completionDate = false;
    }
    if($roleExecutor == 'true') {
      $this->idExecutor = $id;
      $this->idCustomer = false;
      $this->debug($this->getActions($this->activeStatus, $this->completionDate, $this->idExecutor, true));
      } else {
      $this->idCustomer = $id;
      $this->idExecutor = false;
      $this->debug($this->getActions($this->activeStatus, $this->completionDate, $this->idExecutor, false));
      }
    }
  
  public function getActions($activeStatus, $completionDate, $id, $roleExecutor){
    if($roleExecutor == false){
      if ($activeStatus == self::STATUSES['pending']){
        $role = 'заказчика';
        $arrAction = self::ACTIONS['newTask'];
        $arrStatus = self::STATUSES[ 'newTask'];
      } elseif($this->isTimeActuale($completionDate)==true){
        switch ($activeStatus){
       case self::STATUSES['newTask']: 
            $arrAction = self::ACTIONS['allowToTask'].', '.self::ACTIONS['canselTask'];
            $arrStatus = self::STATUSES[ 'inWork'].', '.self::STATUSES[ 'canceled']; 
            break;
       case self::STATUSES['onСheck']: 
            $arrAction = self::ACTIONS['done'].', '.self::ACTIONS['forRevision'];
            $arrStatus = self::STATUSES[ 'completed'].', '.self::STATUSES[ 'inWork']; 
            break; break;
           }
      } elseif($this->isTimeActuale($completionDate)==false){
          $arrAction = "";
          $arrStatus = self::STATUSES[ 'failed'];
      }
      
    } else {
      $role = 'исполнителя';
      if($this->isTimeActuale($completionDate)==true){
        switch ($activeStatus){
       case self::STATUSES['newTask']: 
            $arrAction = self::ACTIONS['respond'];
            $arrStatus = self::STATUSES[ 'pending']; 
            break;
       case self::STATUSES['inWork']: 
            $arrAction = self::ACTIONS['done'].', '.self::ACTIONS['refuse'];
            $arrStatus = self::STATUSES['onСheck'].', '.self::STATUSES[ 'failed']; 
            break; break;
           }
      } elseif($this->isTimeActuale($completionDate)==false){
          $arrAction = "";
          $arrStatus = self::STATUSES[ 'failed'];
      }
    }
    $arr=[
        "id $role: $id",
        "Активный статус: $activeStatus",
        "Доступное действие: ".$arrAction,
        "Возможен переход в статус: ".$arrStatus
      ];
    return $arr;
  }
  private function isTimeActuale($dt){
  if((strtotime($dt)-time()) > 0) return true;
  return false;
  }
  public static function debug($arr){
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
  }
}
