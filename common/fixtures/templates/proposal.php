<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
  'comment' => 'ddd',
  'user_id' => $faker->numberBetween(1, 5),
  'task_id' => $faker->numberBetween(1, 5),
  'budget' => $faker->numberBetween(1, 5),
];

//php yii fixture/generate proposal --count=5

//php yii fixture/load Proposal

