<?php
use app\classes\ContactsImporterGenerator;
require_once __DIR__ . '/../vendor/autoload.php';
require_once 'function.php';
$categoryTab = new ContactsImporterGenerator('data/categories.csv', ['name', 'icon']);
foreach($categoryTab->getArrayFromFile() as $value) {
  $categories[] = $value;
}
//debug($categories);

$cityTab = new ContactsImporterGenerator('data/cities.csv', ['city','lat','long']);
foreach($cityTab->getArrayFromFile() as $value) {
  $cities[] = $value;
}
//debug($cities);

$profilTab = new ContactsImporterGenerator('data/profiles.csv', ['address', 'bd', 'about', 'phone', 'skype']);
foreach($profilTab->getArrayFromFile() as $value) {
  $profiles[] = $value;
}

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
    }
}

//В поле $user[$i]['address'] ставит id массва $cities и в слусае отсутствия данных в $cities дозаполняет их
for ($i = 0; $i < count($user); $i++) {
    $flag = 0;
    for ($j = 0; $j < count($cities); $j++) {
        if($user[$i]['address'] == $cities[$j]['city']){
            $user[$i]['address'] = $cities[$j]['id'];
            $flag = 1;
        }
    }
    if($flag==0){
        array_push($cities, ['id'=>count($cities)+1, 'city'=>$user[$i]['address']]);     
    }
}
for ($i = 0; $i < count($user); $i++) {
     for ($j = 0; $j < count($cities); $j++) {
          if($user[$i]['address'] == $cities[$j]['city']){
                $user[$i]['address'] = $cities[$j]['id'];
          }
     }
}

debug($user);
//debug($cities);

$taskTab = new ContactsImporterGenerator('data/tasks.csv', ['dt_add', 'category_id', 'description', 'expire', 'name', 'address', 'budget', 'lat', 'long']);
foreach($taskTab->getArrayFromFile() as $value) {
  $tasks[] = $value;
}
for ($i = 0; $i < count($tasks); $i++) {
    $flag = 0;
    for ($j = 0; $j < count($cities); $j++) {
        if($tasks[$i]['address'] == $cities[$j]['city']){
            $tasks[$i]['address'] = $cities[$j]['id'];
            $flag = 1;
        }
    }
    if($flag==0){
        array_push($cities, ['id'=>count($cities)+1, 'city'=>$tasks[$i]['address'], 'lat' =>$tasks[$i]['lat'], 'long' =>$tasks[$i]['long'] ]);     
    }
}
for ($i = 0; $i < count($tasks); $i++) {
     for ($j = 0; $j < count($cities); $j++) {
          if($tasks[$i]['address'] == $cities[$j]['city']){
                $tasks[$i]['address'] = $cities[$j]['id'];
          }
     }
}
//debug($tasks);
//debug($cities);
$opinionTab = new ContactsImporterGenerator('data/opinions.csv', ['dt_add', 'rate', 'description']);
foreach($opinionTab->getArrayFromFile() as $value) {
  $opinions[] = $value;
}
for ($i = 0; $i < count($opinions); $i++){
    $opinions[$i]['executor_id'] = mt_rand(0, array_pop($user)['id']);
    $rand = mt_rand(0, array_pop($user)['id']);
    while ($opinions[$i]['executor_id'] == $rand) {
        $rand = mt_rand(0, array_pop($user)['id']);
    }
    $opinions[$i]['customer_id'] = $rand;
    $opinions[$i]['task_id'] = mt_rand(0, array_pop($tasks)['id']);
}
//debug($opinions);

$repliesTab = new ContactsImporterGenerator('data/replies.csv', ['dt_add', 'rate', 'description']);
foreach($repliesTab->getArrayFromFile() as $value) {
  $replies[] = $value;
}

for ($i = 0; $i < count($replies); $i++){
    //$replies[$i]['user_id'] = mt_rand(0, array_pop($user));
    //$replies[$i]['task_id'] = mt_rand(0, array_pop($tasks)['id']);
}
//echo array_pop($user).'<hr>';
//debug($user);