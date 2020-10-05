<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
  'username' => $faker->name,
  'email' => $faker->email,
  'location_id' => $faker->numberBetween(1, 50),
  'password_hash' => '$2y$13$8F3SteHzR1nSGH5zB491rORuIuyakjA7P0iKZdZtswRxC4QIhzrmS',
  'auth_key' => '',
  'created_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
  'updated_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
];

//php yii fixture/generate user --count=5

//php yii fixture/load User