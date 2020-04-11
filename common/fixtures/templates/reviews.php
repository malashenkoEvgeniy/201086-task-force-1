<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
	'creation_time' => $faker->dateTime()->format('Y-m-d H:i:s'),
	'customer_id' => $faker->numberBetween(1, 10),
	'executor_id' => $faker->numberBetween(1,10),
	'assessment'  => $faker->numberBetween(1, 5),
	'task_id'  => $faker->numberBetween(1, 10),
	'comment' => $faker->text,
];


//php yii fixture/generate reviews --count=10

//php yii fixture/load Reviews