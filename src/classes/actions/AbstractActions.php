<?php


namespace app\classes\actions;

use app\classes\Task;

abstract class AbstractActions
{

    abstract static function getName(): string;
    abstract static function getCode(): string;
    abstract static function verificationRights(Task $task): bool;
}
