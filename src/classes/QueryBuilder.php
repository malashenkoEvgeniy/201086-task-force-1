<?php


namespace app\classes;


class QueryBuilder
{
    private $tab;
    public function __construct($tab)
    {
        $this->arr = $tab;
    }

    public function getInsertQuery($arr)
    {
        $result = "INSERT INTO"." `categories`(";
        foreach ($arr as $item){
            $arrayKeys = array_keys($item);
            foreach ($arrayKeys as $key=>$value){
                $arrayKeys[$key] = '`'.$value.'`';
            }
        }
        $result .= implode(', ',$arrayKeys).") VALUES";
        foreach ($arr as $item){
            foreach ($item as $key=>$value){
               $item[$key] = '\''.$value.'\'';
            }
            $result .= " (".implode(', ', $item)."),";
        }

       return $result = substr($result, 0, strlen($result) - 1);
    }
}
