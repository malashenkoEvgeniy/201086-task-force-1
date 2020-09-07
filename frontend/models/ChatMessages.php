<?php

namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "chat_messages".
 *
 * @property int $id
 * @property int $task_id
 * @property int $writer_id
 * @property string|null $comment
 * @property string $creation_time
 * @property int $viewed
 *
 * @property Tasks $task
 * @property Users $writer
 */
class ChatMessages extends ActiveRecord
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
            [['task_id', 'writer_id', 'viewed'], 'required'],
            [['task_id', 'writer_id', 'viewed'], 'integer'],
            [['comment'], 'string'],
            [['creation_time'], 'safe'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['writer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['writer_id' => 'id']],
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
     * Gets query for [[Writer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWriter()
    {
        return $this->hasOne(Users::className(), ['id' => 'writer_id']);
    }
}
