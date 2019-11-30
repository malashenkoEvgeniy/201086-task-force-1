<?php
use app\classes\Task;
use app\classes\actions\ActionStart;


require_once __DIR__ . '/../vendor/autoload.php';

$task = new Task(2);
$task->initiatorId = 2;
$task->executorId = 7;

assert($task->getAvailableActions(2) === Task::ACTION_CANCEL, 'при статусе новая у заказчика доступно только действие отменить');
assert($task->getAvailableActions(7) === Task::ACTION_RESPOND, 'при статусе новая у исполнителя доступно только действие старта');

$task->start();
assert($task->getAvailableActions(2) === Task::ACTION_DONE, 'при статусе в работе у заказчика доступно только действие выполнено');
assert($task->getAvailableActions(7) === Task::ACTION_REFUSE, 'при статусе в работе у исполнителя доступно только действие отказаться');

echo $task->getAvailableActions(2);

//assert($task->status === Task::STATUS_IN_WORK, 'при отклике -статус в работе');
//$task->cancel();
//$task->done();
//$task->refuse();
//$task->doing(7, )
/*
assert( === Task::STATUS_NEW, 'при создании новой задачи возвращается статус новая');
assert($task->getNextStatus(Task::ACTION_CANCEL) === Task::STATUS_CANCELED, 'при создании новой задачи возвращается статус новая');
assert($task->getNextStatus(Task::ACTION_RESPOND) === Task::STATUS_IN_WORK, 'при создании новой задачи возвращается статус новая');
assert($task->getNextStatus(Task::ACTION_DONE) === Task::STATUS_COMPLETED, 'при создании новой задачи возвращается статус новая');
assert($task->getNextStatus(Task::ACTION_REFUSE) === Task::STATUS_FAILED, 'при создании новой задачи возвращается статус новая');
echo 'Все тесты пройдены!';
*/

echo '<hr>';

echo '<pre>';
print_r($task);

echo '</pre>';


/*

AvailableActions::getNextObj(2, $usersId, ActionCreateNew::name());
echo AvailableActions::actions(2, AvailableActions::$task);
//AvailableActions::getNextObj(2, $usersId, ActionCancel::name());
//AvailableActions::getNextObj(4, $usersId, ActionRespond::name());
AvailableActions::getNextObj(5, $usersId, ActionRespond::name());
AvailableActions::getNextObj(2, $usersId, ActionStart::name());
//AvailableActions::getNextObj(5, $usersId, ActionRefuse::name());
AvailableActions::getNextObj(2, $usersId, ActionDone::name());
echo '<pre>';
print_r(AvailableActions::$task);

echo '</pre>';
echo '<hr>';
//echo AvailableActions::actions(5, AvailableActions::$task);
*/
