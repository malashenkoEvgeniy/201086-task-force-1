<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
	'creation_time' => $faker->dateTime()->format('Y-m-d H:i:s'),
	'name' => $faker->name,
	'category_id' => $faker->numberBetween(1, 8),
	'description' => $faker->text(200),
	'location_id' => $faker->numberBetween(1, 500),
	'budget' => $faker->numberBetween(100, 10000),
	'deadline' => $faker->dateTime()->format('Y-m-d H:i:s'),
	'customer_id' => $faker->numberBetween(1,10),
	'executor_id' => $faker->numberBetween(1,10),
	'status' => $faker->text(128)
];
//php yii fixture/generate tasks --count=10

//php yii fixture/load Tasks

