<?php


namespace app\classes\sqlFileCreater;


use app\classes\ContactsImporterGenerator;
use app\classes\Task;
use app\classes\QueryBuilder;


class TasksSqlFileCreater
{
    public $path;

    const DB_FIELDS = 'id, creation_time, category_id, description, deadline, name, location_id, budget, lat, long';
    const CSV_FILELD = ['dt_add', 'category_id', 'description', 'expire', 'name', 'address', 'budget', 'lat', 'long'];

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
        return $arr;
    }
    public function createTasksFile($arrCity, $count_user)
    {
        $counter = count($arrCity)+1;
        $arrTask = $this->execute();
        for ($i = 0; $i < count($arrTask); $i++) {
            $flag = 0;
            for ($j = 0; $j < count($arrCity); $j++) {
                if($arrTask[$i]['location_id'] == $arrCity[$j]['city']){
                    $arrTask[$i]['location_id'] = $arrCity[$j]['id'];
                    $flag = 1;
                }
            }
            if($flag==0){
                array_push($arrCity, ['id'=>$counter, 'city'=>$arrTask[$i]['location_id'], 'lat' =>$arrTask[$i]['lat'], 'long' =>$arrTask[$i]['long'] ]);
                $counter++;
            }
        }
        for ($i = 0; $i < count($arrTask); $i++) {
            for ($j = 0; $j < count($arrCity); $j++) {
                if($arrTask[$i]['location_id'] == $arrCity[$j]['city']){
                    $arrTask[$i]['location_id'] = $arrCity[$j]['id'];
                }
            }
            $arrTask[$i]['customer_id'] = mt_rand(0, $count_user);
            $arrTask[$i]['status'] = Task::STATUS_NEW;
            unset($arrTask[$i]['lat']);
            unset($arrTask[$i]['long']);
        }
        $locQueryBuilder = new QueryBuilder('locations');
        $result = $locQueryBuilder->getInsertQuery($arrCity);
        file_put_contents("../docs/locations.sql", $result);
        $taskQueryBuilder = new QueryBuilder('tasks');
        $result = $taskQueryBuilder->getInsertQuery($arrTask);
        file_put_contents("../docs/tasks.sql", $result);
        return $arrTask;
    }

}
