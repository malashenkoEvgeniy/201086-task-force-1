<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\db\ActiveQuery;
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
 * @property Task $task
 * @property User $user
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
          [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
          [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
          'task_id' => 'AvailableActions ID',
          'budget' => 'Budget',
          'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[AvailableActions]].
     *
     * @return ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
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

    public static function create($task_id, $comment, $budget)
    {
        $proposal = new static();
        $proposal->task_id = $task_id;
        $proposal->comment = $comment;
        $proposal->budget = $budget;
        $proposal->created_at = time();
        $proposal->user_id = Yii::$app->user->identity->id;
        $proposal->save();
        return $proposal;
    }

    public static function isProposal($id)
    {
        $proposal = self::find()->all();
        foreach ($proposal as $item) {
            if ($item->user_id == $id) {
                return true;
            }
        }
        return false;
    }
}
