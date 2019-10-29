<?php

function my_autoloader($class) {
    include 'classes/' . $class . '.class.php';
}

spl_autoload_register('my_autoloader');

$task = new Task('В ожидании', '20.10.1988', 25);
