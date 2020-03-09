<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "proposal".
 *
 * @property int $id
 * @property string $comment
 * @property int $task_id
 * @property int|null $budget
 * @property int $user_id
 *
 * @property Tasks $task
 * @property Users $user
 */
class Proposal extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proposal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment', 'task_id', 'user_id'], 'required'],
            [['task_id', 'budget', 'user_id'], 'integer'],
            [['comment'], 'string', 'max' => 128],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment' => 'Comment',
            'task_id' => 'Task ID',
            'budget' => 'Budget',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'task_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
