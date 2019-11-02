<?php

function my_autoloader($class) {
    include 'classes/' . $class . '.php';
}

spl_autoload_register('my_autoloader');

$task = new Task;
echo assert($task->getNextStatus(Task::ACTION_CREATE_NEW) === Task::STATUS_NEW, 'при создании новой задачи возвращается статус новая');

