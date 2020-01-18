<?php


namespace app\classes\sqlFileCreater;


use app\classes\ContactsImporterGenerator;
use app\classes\QueryBuilder;
//use app\classes\Task;

class CategorySqlFileCreater
{
    public $path;

    const DB_FIELDS = 'id, title, title_en';
    const CSV_FILELD = ['name', 'icon'];

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function execute()
    {
        $arr = [];
        $tab = new ContactsImporterGenerator($this->path, self::CSV_FILELD);
        foreach($tab->getArrayFromFile() as $value) {
            $arr[] =  array_combine(explode(', ', self::DB_FIELDS), array_values($value));
        }
        $queryBuilder = new QueryBuilder('categories');
        $result = $queryBuilder->getInsertQuery($arr);
        file_put_contents("../docs/categories.sql", $result);
        return $arr;
    }
}
