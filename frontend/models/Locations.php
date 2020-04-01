<?php

namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "locations".
 *
 * @property int $id
 * @property string $city
 * @property string $lat
 * @property string $long
 *
 * @property Tasks[] $tasks
 * @property Users[] $users
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
            [['city'], 'unique'],
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

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['location_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['location_id' => 'id']);
    }
}
