<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
	'creation_time' => $faker->dateTime(),
	'name' => $faker->name,
	'category_id' => $faker->numberBetween(1, 8),
	'description' => $faker->text(200),
	'location_id' => $faker->numberBetween(1, 500),
	`budget` => $faker->numberBetween(100, 10000),
	`deadline` => $faker->dateTime(),
	`customer_id` => $faker->numberBetween(),
	`status` => $faker->text
];


