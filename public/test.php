<?php
use app\classes\Task;
use app\classes\actions\ActionStart;
use app\classes\actions\ActionCancel;


require_once __DIR__ . '/../vendor/autoload.php';

$task = new Task(2);
$task->initiatorId = 2;
$task->executorId = 7;
$task->start();
$task->status = Task::STATUS_IN_WORK;

echo '<pre>';
print_r($task->getAvailableActions());
echo '</pre>';

//assert($task->getAvailableActions(7)[0] === Task::ACTION_RESPOND, 'при статусе новая у исполнителя доступно только действие старта');

//$task->start();
//assert($task->getAvailableActions(2)[0] === Task::ACTION_DONE, 'при статусе в работе у заказчика доступно только действие выполнено');
//assert($task->getAvailableActions(7)[0] === Task::ACTION_REFUSE, 'при статусе в работе у исполнителя доступно только действие отказаться');
echo "<hr>";
//print_r($task->getAvailableActions(2));

echo '<hr>';

echo '<pre>';
print_r($task);

echo '</pre>';

