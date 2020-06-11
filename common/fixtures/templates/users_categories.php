<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
	'user_id'  => $faker->numberBetween(0, 10),
	'category_id'  => $faker->numberBetween(0, 8),
];

//php yii fixture/generate users_categories --count=20

//php yii fixture/load UsersCategories