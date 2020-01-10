<?php


namespace app\classes;


class QueryBuilder
{
    private $tab;
    public function __construct($tab)
    {
        $this->arr = $tab;
    }

    public function getInsertQuery($arr, $queryStr)
    {
        $result = "INSERT INTO"." `categories`($queryStr) VALUES";

        foreach ($arr as $item){
            $result .= " ('".implode('\', \'', $item)."'),";
        }

       return $result = substr($result, 0, strlen($result) - 1);
    }


}
