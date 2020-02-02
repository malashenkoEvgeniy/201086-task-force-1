<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proposal".
 *
 * @property int $id
 * @property string $comment
 * @property int $task_id
 * @property int|null $budget
 * @property int $user_id
 */
class Proposal extends \yii\db\ActiveRecord
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
}
