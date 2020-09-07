<?php


namespace app\classes\sqlFileCreater;


use app\classes\ContactsImporterGenerator;
use app\classes\QueryBuilder;

class UsersSqlFileCreater
{
    public $path;
    public $cities;

    const DB_FIELDS = 'id, email, name, password, creation_time';
    const CSV_FILELD = ['email', 'name', 'password', 'dt_add'];

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
    public function createUsersFile($users, $profiles, $cities)
    {
        $counter = count($cities)+1;
        for ($i = 0; $i < count($profiles); $i++) {
           if(!isset( $users[$i])){
               $users[$i]['email'] = '';
               $users[$i]['name'] = '';
               $users[$i]['password'] = '';
               $users[$i]['creation_time'] = '';
           }
           $user[$i] = array_merge($profiles[$i], $users[$i]);
        }

        for ($i = 0; $i < count($user); $i++) {
            $flag = 0;
            for ($j = 0; $j < count($cities); $j++) {
                if($user[$i]['location_id'] == $cities[$j]['city']){
                    $user[$i]['location_id'] = $cities[$j]['id'];
                    $flag = 1;
                }
            }
            if($flag==0){
                array_push($cities, ['id'=>$counter, 'city'=>$user[$i]['location_id'], 'lat' => '', 'long' => '']);
                $counter++;
            }
        }
        for ($i = 0; $i < count($user); $i++) {
            for ($j = 0; $j < count($cities); $j++) {
                if($user[$i]['location_id'] == $cities[$j]['city']){
                    $user[$i]['location_id'] = $cities[$j]['id'];
                }
            }
        }
        $cities = array_merge($cities, $cities);
        $this->cities = $cities;
        $queryBuilder = new QueryBuilder('users');
        $result = $queryBuilder->getInsertQuery($user);
        file_put_contents("../docs/users.sql", $result);
        return $user;
    }
}
