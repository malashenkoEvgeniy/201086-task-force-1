<?php
use app\classes\Task;
use app\classes\actions\ActionStart;


require_once __DIR__ . '/../vendor/autoload.php';

$task = new Task(2);
$task->initiatorId = 2;
$task->executorId = 7;
$task->getAvailableActions(2);
//assert($task->getAvailableActions(2) === Task::ACTION_CANCEL, 'при статусе новая у заказчика доступно только действие отменить');
//assert($task->getAvailableActions(7) === Task::ACTION_RESPOND, 'при статусе новая у исполнителя доступно только действие старта');

//$task->start();
//assert($task->getAvailableActions(2) === Task::ACTION_DONE, 'при статусе в работе у заказчика доступно только действие выполнено');
//assert($task->getAvailableActions(7) === Task::ACTION_REFUSE, 'при статусе в работе у исполнителя доступно только действие отказаться');

print_r($task->getAvailableActions(7));

echo '<hr>';

echo '<pre>';
print_r($task);

echo '</pre>';

