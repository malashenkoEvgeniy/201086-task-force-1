<?php

namespace app\models;

use Yii\db\ActiveRecord;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property string $path
 * @property int $user_id
 * @property int|null $task_id
 */
class File extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path', 'user_id'], 'required'],
            [['user_id', 'task_id'], 'integer'],
            [['path'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'user_id' => 'User ID',
            'task_id' => 'Task ID',
        ];
    }

	public function getIdTasks() {
		return $this->hasOne(Tasks::class, ['id' => 'task_id']);
	}

	public function getIdUsers() {
		return $this->hasOne(Users::class, ['id' => 'user_id']);
	}
}
