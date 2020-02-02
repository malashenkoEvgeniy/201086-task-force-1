<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat_messages".
 *
 * @property int $id
 * @property int $task_id
 * @property int $writer_id
 * @property string $comment
 * @property string $creation_time
 * @property int $viewed
 */
class ChatMessages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat_messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'writer_id', 'comment', 'viewed'], 'required'],
            [['task_id', 'writer_id', 'viewed'], 'integer'],
            [['comment'], 'string'],
            [['creation_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'writer_id' => 'Writer ID',
            'comment' => 'Comment',
            'creation_time' => 'Creation Time',
            'viewed' => 'Viewed',
        ];
    }
}
