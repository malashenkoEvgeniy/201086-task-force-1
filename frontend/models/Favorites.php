<?php

namespace app\models;

use frontend\models\Users;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "favorites".
 *
 * @property int $id
 * @property int $user_id
 * @property int $favorites_id
 */
class Favorites extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'favorites_id'], 'required'],
            [['user_id', 'favorites_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Users ID',
            'favorites_id' => 'Favorites ID',
        ];
    }

	/**
	 * Gets query for [[Users]].
	 *
	 * @return ActiveQuery
	 */
	public function getUsers()
	{
		return $this->hasOne(Users::class, ['id' => 'user_id']);
	}
}
