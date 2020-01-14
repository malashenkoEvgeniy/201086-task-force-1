<?php


namespace app\classes;

class CategorySqlFileCreater
{
    public $path;
    public $location = [];


    const CATAGORIES_FILDS = 'id, title, title_en';
    const CATAGORIES_FILE = ['name', 'icon'];
    const CITIES_FILE = ['city','lat','long'];
    const CITIES_FILDS = 'id, city, lat, long';
    const PROFILES_FILE = ['address', 'bd', 'about', 'phone', 'skype'];
    const PROFILES_FILDS = 'id, location_id, birthday, info, phone, skype';
    const USERS_FILE = ['email', 'name', 'password', 'dt_add'];
    const USERS_FILDS = 'id, email, name, password, creation_time';
    const TASK_FILE = ['dt_add', 'category_id', 'description', 'expire', 'name', 'address', 'budget', 'lat', 'long'];
    const TASK_FILDS = 'id, creation_time, category_id, description, deadline, name, location_id, budget, lat, long';
    const REVIEWS_FILE = ['dt_add', 'rate', 'description'];
    const REVIEWS_FILDS = 'id, creation_time, assessment, comment';

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function execute($file, $filds)
    {
        $arr = [];
        $tab = new ContactsImporterGenerator($this->path, $file);
        foreach($tab->getArrayFromFile() as $value) {
            $arr[] =  array_combine(explode(', ',$filds), array_values($value));
        }
        return $arr;
    }

    public function queryBuildInFile($tab, $file, $filds, $arr = null)
    {
        if($arr === null) {
            $arr = $this->execute($file, $filds);
        }
        $queryBuilder = new QueryBuilder($tab);
        $result = $queryBuilder->getInsertQuery($arr);
        file_put_contents("../docs/".$tab.".sql", $result);
    }

    public function createUsersFile($profiles, $users, $cities)
    {
        $counter = count($cities)+1;
        for ($i = 0; $i < count($profiles); $i++) {
            if($profiles[$i]['id']==$users[$i]['id']){
                $user[$i] = array_merge($profiles[$i], $users[$i]);
            }
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
                array_push($this->location, ['id'=>$counter, 'city'=>$user[$i]['location_id'], 'lat' => '', 'long' => '']);
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
        $this->location = array_merge($cities, $this->location);
        return $user;
    }

    public function createTasksFile($arrTask, $arrCity, $count_user)
    {

        $counter = count($arrCity)+1;
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
        $this->queryBuildInFile('locations', self::CITIES_FILE, self::CITIES_FILDS, $arrCity);
        return $arrTask;
    }

    public function createReviewsFile($arrReviews, $count_user, $count_task)
    {
        for ($i = 0; $i < count($arrReviews); $i++){
            $arrReviews[$i]['executor_id'] = mt_rand(1, $count_user);
            $rand = mt_rand(1, $count_user);
            while ($arrReviews[$i]['executor_id'] == $rand) {
                $rand = mt_rand(1, $count_user);
            }
            $arrReviews[$i]['customer_id'] = $rand;
            $arrReviews[$i]['task_id'] = mt_rand(1, $count_task);
        }
        $this->queryBuildInFile('reviews', self::REVIEWS_FILE, self::REVIEWS_FILDS, $arrReviews);
        return $arrReviews;
    }
}
