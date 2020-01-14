<?php

use app\classes\CategorySqlFileCreater;
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__.'\..\function.php';

$categories = new CategorySqlFileCreater(__DIR__ . '\data\categories.csv');
$categories->queryBuildInFile('categories', $categories::CATAGORIES_FILE, $categories::CATAGORIES_FILDS);

$cities = new CategorySqlFileCreater(__DIR__ . '\data\cities.csv');

$profiles = new CategorySqlFileCreater(__DIR__ . '\data\profiles.csv');

$users = new CategorySqlFileCreater(__DIR__ . '\data\users.csv');
$user = $users->createUsersFile($profiles->execute($profiles::PROFILES_FILE, $profiles::PROFILES_FILDS), $users->execute($users::USERS_FILE, $users::USERS_FILDS), $cities->execute($cities::CITIES_FILE, $cities::CITIES_FILDS));
$users->queryBuildInFile('users', $users::USERS_FILE, $users::USERS_FILDS, $user);

$tasks = new CategorySqlFileCreater(__DIR__ . '\data\tasks.csv');
$arrTask = $tasks->execute($tasks::TASK_FILE, $tasks::TASK_FILDS);

$arrTaskForQuery = $tasks->createTasksFile($arrTask, $users->location, count($user));
$tasks->queryBuildInFile('tasks', $tasks::TASK_FILE, $tasks::TASK_FILDS, $arrTaskForQuery);

$reviews = new CategorySqlFileCreater(__DIR__ . '\data\opinions.csv');
$arrReviews = $reviews->execute($reviews::REVIEWS_FILE, $reviews::REVIEWS_FILDS);
$reviews->createReviewsFile($arrReviews, count($user), count($arrTask));
