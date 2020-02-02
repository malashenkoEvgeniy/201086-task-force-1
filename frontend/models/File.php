<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property string $path
 * @property int $user_id
 * @property int|null $task_id
 */
class File extends \yii\db\ActiveRecord
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
}
