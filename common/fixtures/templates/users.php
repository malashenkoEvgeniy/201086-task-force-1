<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
try {
	return [
		'creation_time' => $faker->dateTime()->format('Y-m-d H:i:s'),
		'name' => $faker->name(),
		'email' => $faker->email,
		'location_id' => $faker->numberBetween(1, 500),//нужно число count(location_id)
		'birthday' => $faker->dateTimeThisCentury->format('Y-m-d H:i:s'),
		'info' => $faker->text,
		'password' => Yii::$app->getSecurity()->generatePasswordHash('password_' . $index),
		'phone' => substr($faker->e164PhoneNumber, 1, 11),
		'skype' => $faker->userName,
		'another_messenger' => $faker->text($maxNbChars = 128) ,
		'avatar'  => 'img/avatar/ava'.$faker->numberBetween(1, 8).'.jpg',
		'task_name'=> $faker->text($maxNbChars = 128),
		'show_contacts_for_customer'  => $faker->boolean,
  	'hide_profile' => $faker->boolean,
		'last_visit_time'=>$faker->dateTime()->format('Y-m-d H:i:s'),
		'popularity' => $faker->numberBetween(0, 20),
		'now_free' => $faker->boolean,
		'is_executor' =>$faker->boolean
	];
} catch (\yii\base\Exception $e) {
}

//php yii fixture/generate users --count=50

//php yii fixture/load Users