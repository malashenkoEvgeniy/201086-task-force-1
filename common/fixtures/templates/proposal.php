<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
try {
	return [
		'comment'=> $faker->text($maxNbChars = 128),
		'task_id'  => $faker->numberBetween(1, 10),
		'budget' => $faker->numberBetween(100, 10000),
		'user_id'  => $faker->numberBetween(0, 10),
	];
} catch (\yii\base\Exception $e) {
}

//php yii fixture/generate proposal --count=20

//php yii fixture/load Proposal