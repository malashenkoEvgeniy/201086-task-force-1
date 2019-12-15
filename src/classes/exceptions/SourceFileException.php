<?php


namespace app\classes\exceptions;


use Throwable;

class SourceFileException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
    public function sameMethod()
    {
        echo __CLASS__;
    }
}
