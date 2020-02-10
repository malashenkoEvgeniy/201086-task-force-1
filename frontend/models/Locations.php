<?php

namespace app\models;

use Yii\db\ActiveRecord;

/**
 * This is the model class for table "locations".
 *
 * @property int $id
 * @property string $city
 * @property string $lat
 * @property string $long
 */
class Locations extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city', 'lat', 'long'], 'required'],
            [['city', 'lat', 'long'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city' => 'City',
            'lat' => 'Lat',
            'long' => 'Long',
        ];
    }

	public function getUsers() {
		return $this->hasMany(Users::class, ['location_id' => 'id'])->inverseOf('usersLoc');
	}

	public function getTasks() {
		return $this->hasMany(Tasks::class, ['location_id' => 'id'])->inverseOf('tasksLoc');
	}
}
