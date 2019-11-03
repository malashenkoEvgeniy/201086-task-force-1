<?php
use app\classes\Task;

require_once __DIR__ . '/../vendor/autoload.php';

$task = new Task(26, '18/012/2019');
assert($task->getNextStatus(Task::ACTION_CREATE_NEW) === Task::STATUS_NEW, 'при создании новой задачи возвращается статус новая');
assert($task->getNextStatus(Task::ACTION_CANCEL) === Task::STATUS_CANCELED, 'при создании новой задачи возвращается статус новая');
assert($task->getNextStatus(Task::ACTION_RESPOND) === Task::STATUS_IN_WORK, 'при создании новой задачи возвращается статус новая');
assert($task->getNextStatus(Task::ACTION_DONE) === Task::STATUS_COMPLETED, 'при создании новой задачи возвращается статус новая');
assert($task->getNextStatus(Task::ACTION_REFUSE) === Task::STATUS_FAILED, 'при создании новой задачи возвращается статус новая');
echo 'Все тесты пройдены!';
