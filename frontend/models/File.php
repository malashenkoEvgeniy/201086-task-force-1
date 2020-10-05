<?php

namespace frontend\models;


use common\models\User;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property string $path
 * @property int $user_id
 * @property int|null $task_id
 *
 * @property Task $task
 * @property User $user
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
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::class, 'targetAttribute' => ['task_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
          'task_id' => 'AvailableActions ID',
        ];
    }

    /**
     * Gets query for [[AvailableActions]].
     *
     * @return ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::class, ['id' => 'task_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function create($user, $task, $path)
    {
      $file = new static;
      $file->user_id = $user;
      $file->task_id = $task;
      $file->path = $path;

      return $file;
    }
}
