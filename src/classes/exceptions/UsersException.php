<?php


namespace app\classes\exceptions;


use Throwable;

class UsersException extends \Exception
{
    function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
    public function sameMethod()
    {
        echo __CLASS__;
    }
}
