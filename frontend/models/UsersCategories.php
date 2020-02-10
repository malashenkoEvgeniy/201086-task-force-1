<?php

namespace app\models;

use Yii\db\ActiveRecord;

/**
 * This is the model class for table "users_categories".
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 */
class UsersCategories extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id'], 'required'],
            [['user_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
        ];
    }

	public function getIdCategories() {
		return $this->hasOne(Categories::class, ['id' => 'category_id']);
	}

	public function getIdUsers() {
		return $this->hasOne(Users::class, ['id' => 'user_id']);
	}
}
