<?php
use app\classes\Task;
use app\classes\exceptions\TimeExeption;
use app\classes\exceptions\UsersException;
use app\classes\exceptions\IncorrectActionStatusException;


require_once __DIR__ . '/../vendor/autoload.php';
try {
    $task = new Task(2, '18.08.2020');
    if (strtotime($task->completionTime) < time()) {
        throw new TimeExeption('ВЫ указали время в прошлом!');
    }
    if ($task->initiatorId !== $task->customerId AND $task->initiatorId !== $task->executorId) {
        throw new UsersException('По этому заданию Вам не доступно ни каких действий');
    }
} catch(UsersException $e) {
    echo $e->sameMethod() . ":" . $e->getMessage();
} catch(TimeExeption $e) {
        echo $e->sameMethod() . ":" . $e->getMessage();
}

$task->initiatorId = 2;
$task->executorId = 5;
//$task->status = Task::STATUS_IN_WORK;

//$task->cancel();

/*
echo '<pre>';
print_r($task->getAvailableActions());
echo '</pre>';
*/
//assert($task->getAvailableActions(7)[0] === Task::ACTION_RESPOND, 'при статусе новая у исполнителя доступно только действие старта');

//$task->start();
//assert($task->getAvailableActions(2)[0] === Task::ACTION_DONE, 'при статусе в работе у заказчика доступно только действие выполнено');
//assert($task->getAvailableActions(7)[0] === Task::ACTION_REFUSE, 'при статусе в работе у исполнителя доступно только действие отказаться');
echo "<hr>";
print_r($task->getAvailableActions());
echo '<hr>';

echo '<pre>';
print_r($task);

echo '</pre>';

/*try {
            */
