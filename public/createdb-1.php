<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once 'function.php';
$categories = getArrayFromFile('data/categories.csv', ['name', 'icon']);
$cities = getArrayFromFile('data/cities.csv', ['city','lat','long']);
$profiles = getArrayFromFile('data/profiles.csv', ['address', 'bd', 'about', 'phone', 'skype']);
$users = getArrayFromFile('data/users.csv', ['email', 'name', 'password', 'dt_add']);
require_once 'createdb/createusertab.php';
$tasks = getArrayFromFile('data/tasks.csv', ['dt_add', 'category_id', 'description', 'expire', 'name', 'address', 'budget', 'lat', 'long']);
require_once 'createdb/createtaskstab.php';
$opinions = getArrayFromFile('data/opinions.csv', ['dt_add', 'rate', 'description']);
require_once 'createdb/createopinionstab.php';
$replies = getArrayFromFile('data/replies.csv', ['dt_add', 'rate', 'description']);
for ($i = 0; $i < count($replies); $i++){
    $replies[$i]['user_id'] = mt_rand(0, array_pop($user)['id']);
    $replies[$i]['task_id'] = mt_rand(0, array_pop($tasks)['id']);
}


require_once 'createdb/categories.php';
require_once 'createdb/locations.php';
require_once 'createdb/users.php';
$result = "INSERT INTO"." `tasks`(`id`, `creation_time`, `name`, `category_id`, `description`, `location_id`, `budget`, `deadline`, `customer_id`, `executor_id`, `status`) VALUES";

for ($i = 0; $i < count($tasks); $i++) {
        $id = $tasks[$i]['id'];
        $creation_time = $tasks[$i]['dt_add'];
        $name = $tasks[$i]['name'];
        $category_id = $tasks[$i]['category_id'];
        $description = $tasks[$i]['description'];
        $location_id = $tasks[$i]['adress'];
        $budget = $tasks[$i]['budget'];
        $deadline = $tasks[$i]['expire'];
        
        

    
        
        $result .= "(\"$id\",\"$creation_time\",\"$name\", \"$email\",\"$location_id\",\"$birthday\",\"$info\",\"$password\", \"$phone\", \"$skype\")";
        if ($i !== (count($profiles)-1)) {
            $result .= ",";
        }
}
//file_put_contents("../docs/tasks.sql", $result);

echo '<hr>'.$result;
$t_proposal = [`id`, `comment`, `task_id`, `budget`, `user_id`];
/*******users**********/
$t_users =[`id`, `birthday`,`creation_time`, `name`, `email`, `location_id`,  `info`, `password`, `phone`, `skype`, `another_messenger`, `avatar`, `task_name`, `show_contacts_for_customer`, `hide_profile`];
require_once 'createdb/users.php';
$t_reviews = [`id`,`creation_time`, `executor_id`, `customer_id`, `assessment`, `task_id`, `comment`];
$t_proposal = [`id`, `comment`, `task_id`, `budget`, `user_id`];
$t_users_categories = [`id`, `user_id`, `category_id`];
$t_email_settings = [`id`, `user_id`, `proposal`, `chat_message`, `refuse`, `start_task`, `completion_task`];
$t_reviews = [`id`, `executor_id`, `customer_id`, `assessment`, `task_id`, `comment`];
$t_task = [`id`, `creation_time`, `name`, `category_id`, `description`, `location_id`, `budget`, `deadline`, `customer_id`, `executor_id`, `status`];
echo '<hr>';

/**tasks***/
//
$t_chat_messages = [`id`, `task_id`, `writer_id`, `comment`, `creation_time`, `viewed`];
/****locations****/
$t_locations =[`id`, `city`, `lat`, `long`];

$t_file = [`id`, `path`, `user_id`, `task_id`];





