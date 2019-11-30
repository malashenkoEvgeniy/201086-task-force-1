<?php
use app\classes\Task;
use app\classes\AvailableActions;
use app\classes\AbstractActions;
use app\classes\ActionCancel;
use app\classes\ActionRespond;
use app\classes\ActionDone;
use app\classes\ActionRefuse;
use app\classes\ActionCreateNew;
use app\classes\ActionStart;

require_once 'temp/temp_data.php';
require_once __DIR__ . '/../vendor/autoload.php';

$task = new Task(2);
$task->executorId = 7;
$task->start();
/*
assert($task->getNextStatus(Task::ACTION_CREATE_NEW) === Task::STATUS_NEW, 'при создании новой задачи возвращается статус новая');
assert($task->getNextStatus(Task::ACTION_CANCEL) === Task::STATUS_CANCELED, 'при создании новой задачи возвращается статус новая');
assert($task->getNextStatus(Task::ACTION_RESPOND) === Task::STATUS_IN_WORK, 'при создании новой задачи возвращается статус новая');
assert($task->getNextStatus(Task::ACTION_DONE) === Task::STATUS_COMPLETED, 'при создании новой задачи возвращается статус новая');
assert($task->getNextStatus(Task::ACTION_REFUSE) === Task::STATUS_FAILED, 'при создании новой задачи возвращается статус новая');
echo 'Все тесты пройдены!';
*/
//Привет! На мой взгляд задание выполнено, правда не знаю как написать тесты! Я понимаю, что после твоих замечаний
//код сильно изменится и картина прояснится!! :) По этому отправляю на первую проверку!
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
