<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
try {
	return [
		'user_id' => $faker->numberBetween(1, 20),
		'favorites_id' => $faker->numberBetween(1, 50),
	];
} catch (\yii\base\Exception $e) {
}

//php yii fixture/generate favorites --count=20

//php yii fixture/load Favorites