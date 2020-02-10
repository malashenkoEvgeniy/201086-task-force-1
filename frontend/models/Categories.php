<?php

namespace app\models;

use Yii\db\ActiveRecord;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $title
 * @property string $title_en
 */
class Categories extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'title_en'], 'required'],
            [['title', 'title_en'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'title_en' => 'Title En',
        ];
    }

	public function getTasks() {
		return $this->hasMany(Tasks::class, ['category_id' => 'id'])->inverseOf('categories');
	}

	public function getUsersCategories() {
		return $this->hasMany(UsersCategories::class, ['category_id' => 'id']);
	}
}
