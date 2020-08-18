<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
	'created_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
  'updated_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
	'name' => $faker->name,
	'category_id' => $faker->numberBetween(1, 8),
	'description' => $faker->text(200),
	'location_id' => $faker->numberBetween(1, 500),
	'budget' => $faker->numberBetween(100, 10000),
	'deadline' => $faker->dateTime()->format('Y-m-d H:i:s'),
	'customer_id' => $faker->numberBetween(1,10),
	'executor_id' => $faker->numberBetween(1,10),
	'status' => $faker->numberBetween(0, 4),
];
//php yii fixture/generate task --count=10

//php yii fixture/load Task
