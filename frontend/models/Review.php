<?php

namespace frontend\models;

use common\models\User;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property string $creation_time
 * @property int|null $customer_id
 * @property int|null $executor_id
 * @property int|null $assessment
 * @property int|null $task_id
 * @property string|null $comment
 *
 * @property User $customer
 * @property User $executor
 * @property Task $task
 */
class Review extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creation_time'], 'safe'],
            [['customer_id', 'executor_id', 'assessment', 'task_id'], 'integer'],
            [['comment'], 'string'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['executor_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
          'id' => 'ID',
          'creation_time' => 'Creation Time',
          'customer_id' => 'Customer ID',
          'executor_id' => 'Executor ID',
          'assessment' => 'Assessment',
          'task_id' => 'AvailableActions ID',
          'comment' => 'Comment',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(User::className(), ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[Executor]].
     *
     * @return ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(User::className(), ['id' => 'executor_id']);
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

    public static function create($customer_id, $executor_id, $task_id, $comment, $assessment = 5)
    {
        $review = new static();
        $review->creation_time = date('Y-m-d H:s:i', time());
        $review->customer_id = $customer_id;
        $review->executor_id = $executor_id;
        $review->task_id = $task_id;
        $review->comment = $comment;
        $review->assessment = $assessment;
        $review->save();
        return $review;
    }
}
