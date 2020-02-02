<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "email_settings".
 *
 * @property int $id
 * @property int $user_id
 * @property int $proposal
 * @property int $chat_message
 * @property int $refuse
 * @property int $start_task
 * @property int $completion_task
 */
class EmailSettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'email_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'proposal', 'chat_message', 'refuse', 'start_task', 'completion_task'], 'required'],
            [['user_id', 'proposal', 'chat_message', 'refuse', 'start_task', 'completion_task'], 'integer'],
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
            'proposal' => 'Proposal',
            'chat_message' => 'Chat Message',
            'refuse' => 'Refuse',
            'start_task' => 'Start Task',
            'completion_task' => 'Completion Task',
        ];
    }
}
