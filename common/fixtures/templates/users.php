<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
try {
	return [
		'creation_time' => $faker->dateTime(),
		`name` => $faker->name(),
		'email' => $faker->email,
		'location_id' => $faker->numberBetween(1, 500),
		`birthday` => $faker->dateTimeThisCentury->format(' Ymd '),
		`info` => $faker->text,
		'password' => Yii::$app->getSecurity()->generatePasswordHash('password_' . $index),
		'phone' => substr($faker->e164PhoneNumber, 1, 11),
		'company' => $faker->company,
		`skype` => $faker->text,
		`another_messenger` => $faker->text,
		`avatar`  => $faker->text,
		`task_name`=> $faker->text,
		`show_contacts_for_customer`  => $faker->boolean,
  	`hide_profile` => $faker->boolean,


	];
} catch (\yii\base\Exception $e) {
}



