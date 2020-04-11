<?php


namespace common\fixtures;


use frontend\models\UsersCategories;
use yii\test\ActiveFixture;

class UsersCategoriesFixture extends ActiveFixture
{
	public $modelClass = UsersCategories::class;
}
/*

  CREATE TABLE reviews (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `creation_time` DATETIME DEFAULT NOW() NOT NULL,
    `executor_id` INT NULL,
    `customer_id` INT NULL,
    `assessment` INT NULL,
    `task_id` INT NULL,
    `comment` TEXT NULL
  );
*/