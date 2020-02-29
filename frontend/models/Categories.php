<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;


/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $title
 * @property string $title_en
 *
 * @property Tasks[] $tasks
 * @property UsersCategories[] $usersCategories
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
            [['title'], 'unique'],
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

    /**
     * Gets query for [[Tasks]].
     *
     * @return ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['category_id' => 'id']);
    }

    /**
     * Gets query for [[UsersCategories]].
     *
     * @return ActiveQuery
     */
    public function getUsersCategories()
    {
        return $this->hasMany(UsersCategories::className(), ['category_id' => 'id']);
    }
}
