<?php


use app\classes\sqlFileCreater\CategorySqlFileCreater;
use app\classes\sqlFileCreater\UsersSqlFileCreater;
use app\classes\sqlFileCreater\ProfilesSqlFileCreater;
use app\classes\sqlFileCreater\CitiesSqlFileCreater;
use app\classes\sqlFileCreater\TasksSqlFileCreater;
use app\classes\sqlFileCreater\ReviewsSqlFileCreater;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__.'\..\function.php';

$category = new CategorySqlFileCreater(__DIR__ . '/data/categories.csv');
$category->execute();

$profiles = new ProfilesSqlFileCreater(__DIR__ . '\data\profiles.csv');
$profilesArr = $profiles->execute();

$cities = new CitiesSqlFileCreater(__DIR__ . '\data\cities.csv');
$cityArr = $cities->execute();


$users = new UsersSqlFileCreater(__DIR__ . '\data\users.csv');
$users->execute();
$user = $users->createUsersFile($profilesArr, $cityArr);

$tasks = new TasksSqlFileCreater(__DIR__ . '\data\tasks.csv');
$arrTask = $tasks->execute();
$tasks->createTasksFile($users->cities, count($user));


$reviews = new ReviewsSqlFileCreater(__DIR__ . '\data\opinions.csv');
$reviews->execute();
$reviews->createReviewsFile(count($user), count($arrTask));
