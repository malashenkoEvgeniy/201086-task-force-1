<?php
use app\classes\ContactsImporterGenerator;
use app\classes\Task;
use app\classes\QueryBuilder;
require_once __DIR__ . '/../vendor/autoload.php';
$categories = [];
$categoryTab = new ContactsImporterGenerator('data/categories.csv', ['name', 'icon']);
foreach($categoryTab->getArrayFromFile() as $value) {
    $categories[] =  array_combine(['id', 'title', 'title_en'], array_values($value));
    }

$queryBuilderCategory = new QueryBuilder('categories'); // конструктор принимает имя таблицы
$result = $queryBuilderCategory->getInsertQuery($categories); // Передаем массив с данными записи и получаем строку, содержащую INSERT запрос
//echo $result.'<hr>';
file_put_contents("../docs/categories.sql", $result);
/***********************************************************************************/

$cities = [];
$cityTab = new ContactsImporterGenerator('data/cities.csv', ['city','lat','long']);
foreach($cityTab->getArrayFromFile() as $value) {
  $cities[] = $value;
}

$profiles = [];
$profilTab = new ContactsImporterGenerator('data/profiles.csv', ['address', 'bd', 'about', 'phone', 'skype']);
foreach($profilTab->getArrayFromFile() as $value) {
  $profiles[] = $value;
}

$users = [];
$userTab = new ContactsImporterGenerator('data/users.csv', ['email', 'name', 'password', 'dt_add']);
foreach($userTab->getArrayFromFile() as $value) {
  $users[] = $value;
}

//Соеденяет массив $profiles и $users
for ($i = 0; $i < count($profiles); $i++) {
    if($profiles[$i]['id']==$users[$i]['id']){
        $user[$i] = array_merge($profiles[$i], $users[$i]);
    }
    if($users[$i]['id']==null){
        $user[$i] = $profiles[$i];
        $user[$i]['email'] = '';
        $user[$i]['name'] = '';
        $user[$i]['password'] = '';
        $user[$i]['dt_add'] = '';
    }
}

//В поле $user[$i]['address'] ставит id массва $cities и в слусае отсутствия данных в $cities дозаполняет их
for ($i = 0; $i < count($user); $i++) {
    $flag = 0;
    for ($j = 0; $j < count($cities); $j++) {
        if($user[$i]['address'] == $cities[$j]['city']){
            $user[$i]['location_id'] = $cities[$j]['id'];
            $flag = 1;
        }
    }
    if($flag==0){
        array_push($cities, ['id'=>count($cities)+1, 'city'=>$user[$i]['address'], 'lat' => '', 'long' => '']);
    }
}
for ($i = 0; $i < count($user); $i++) {
     for ($j = 0; $j < count($cities); $j++) {
          if($user[$i]['address'] == $cities[$j]['city']){
              $user[$i]['location_id'] = $cities[$j]['id'];
              $user[$i]['birthday'] = $user[$i]['bd'];
              $user[$i]['info'] = $user[$i]['about'];
              $user[$i]['creation_time'] = $user[$i]['dt_add'];
              unset($user[$i]['dt_add']);
              unset($user[$i]['address']);
              unset($user[$i]['bd']);
              unset($user[$i]['about']);
          }
     }
}
$count_user = count($user);

$queryBuilderUser = new QueryBuilder('users'); // конструктор принимает имя таблицы
$result = $queryBuilderUser->getInsertQuery($user); // Передаем массив с данными записи и получаем строку, содержащую INSERT запрос
file_put_contents("../docs/users.sql", $result);

$taskTab = new ContactsImporterGenerator('data/tasks.csv', ['dt_add', 'category_id', 'description', 'expire', 'name', 'address', 'budget', 'lat', 'long']);
foreach($taskTab->getArrayFromFile() as $value) {
  $tasks[] = array_combine(['id', 'creation_time', 'category_id', 'description', 'deadline', 'name' ,  'location_id', 'budget', 'lat', 'long'], array_values($value));
}

for ($i = 0; $i < count($tasks); $i++) {
    $flag = 0;
    for ($j = 0; $j < count($cities); $j++) {
        if($tasks[$i]['location_id'] == $cities[$j]['city']){
            $tasks[$i]['location_id'] = $cities[$j]['id'];
            $flag = 1;
        }
    }
    if($flag==0){
        array_push($cities, ['id'=>count($cities)+1, 'city'=>$tasks[$i]['location_id'], 'lat' =>$tasks[$i]['lat'], 'long' =>$tasks[$i]['long'] ]);
    }
}
for ($i = 0; $i < count($tasks); $i++) {
     for ($j = 0; $j < count($cities); $j++) {
          if($tasks[$i]['location_id'] == $cities[$j]['city']){
                $tasks[$i]['location_id'] = $cities[$j]['id'];
          }
     }
    $tasks[$i]['customer_id'] = mt_rand(0, $count_user);
    $tasks[$i]['status'] = Task::STATUS_NEW;
    unset($tasks[$i]['lat']);
    unset($tasks[$i]['long']);

}

$count_task = count($tasks);

$queryBuilderTask = new QueryBuilder('task'); // конструктор принимает имя таблицы
$result = $queryBuilderTask->getInsertQuery($tasks); // Передаем массив с данными записи и получаем строку, содержащую INSERT запрос
file_put_contents("../docs/tasks.sql", $result);


$queryBuilderLocation = new QueryBuilder('locations'); // конструктор принимает имя таблицы
$result = $queryBuilderLocation->getInsertQuery($cities); // Передаем массив с данными записи и получаем строку, содержащую INSERT запрос
file_put_contents("../docs/locations.sql", $result);

$opinionTab = new ContactsImporterGenerator('data/opinions.csv', ['dt_add', 'rate', 'description']);
foreach($opinionTab->getArrayFromFile() as $value) {
  $opinions[] =  array_combine(['id', 'creation_time', 'assessment', 'comment'], array_values($value));

}
for ($i = 0; $i < count($opinions); $i++){
    $opinions[$i]['executor_id'] = mt_rand(1, $count_user);
    $rand = mt_rand(1, $count_user);
    while ($opinions[$i]['executor_id'] == $rand) {
        $rand = mt_rand(1, $count_user);
    }
    $opinions[$i]['customer_id'] = $rand;
    $opinions[$i]['task_id'] = mt_rand(1, $count_task);
}
$queryBuilderReviews = new QueryBuilder('reviews'); // конструктор принимает имя таблицы
$result = $queryBuilderReviews->getInsertQuery($opinions);
file_put_contents("../docs/reviews.sql", $result);



$repliesTab = new ContactsImporterGenerator('data/replies.csv', ['dt_add', 'rate', 'description']);
foreach($repliesTab->getArrayFromFile() as $value) {
  $replies[] = $value;
}

for ($i = 0; $i < count($replies); $i++){
    $replies[$i]['user_id'] = mt_rand(1, $count_user);
    $replies[$i]['task_id'] = mt_rand(1, $count_task);
}
