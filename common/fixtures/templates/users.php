<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
try {
	return [
		'creation_time' => $faker->dateTime(),
		'name' => $faker->name(),
		'email' => $faker->email,
		'location_id' => $faker->numberBetween(1, 500),//нужно число count(location_id)
		'birthday' => $faker->dateTimeThisCentury,
		'info' => $faker->text,
		'password' => Yii::$app->getSecurity()->generatePasswordHash('password_' . $index),
		'phone' => substr($faker->e164PhoneNumber, 1, 11),
		'company' => $faker->company,
		'skype' => $faker->text,
		'another_messenger' => $faker->text,
		'avatar'  => './img/avatar/ava'.$faker->numberBetween(1, 8).'.jpg',
		'task_name'=> $faker->text,
		'show_contacts_for_customer'  => $faker->boolean,
  	'hide_profile' => $faker->boolean,
		'last_visit_time'=>$faker->unixTime($max = 'now')


	];
} catch (\yii\base\Exception $e) {
}

//php yii fixture/generate users --count=10

//php yii fixture/load Users