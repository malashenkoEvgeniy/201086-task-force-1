<?php

namespace frontend\models;

use common\models\User;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "location".
 *
 * @property int $id
 * @property string $city
 * @property int|null $lat
 * @property int|null $long
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
            [['city'], 'required'],
            [['lat', 'long'], 'integer'],
            [['city'], 'string', 'max' => 128],
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
     * Gets query for [[AvailableActions]].
     *
     * @return ActiveQuery
     */
    public function getTask()
    {
      return $this->hasMany(Task::className(), ['location_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
      return $this->hasMany(User::className(), ['location_id' => 'id']);
    }
}
