<?php

namespace app\models;

use Yii\db\ActiveRecord;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property string $creation_time
 * @property int|null $executor_id
 * @property int|null $customer_id
 * @property int|null $assessment
 * @property int|null $task_id
 * @property string|null $comment
 */
class Reviews extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creation_time'], 'safe'],
            [['executor_id', 'customer_id', 'assessment', 'task_id'], 'integer'],
            [['comment'], 'string'],
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
            'executor_id' => 'Executor ID',
            'customer_id' => 'Customer ID',
            'assessment' => 'Assessment',
            'task_id' => 'Task ID',
            'comment' => 'Comment',
        ];
    }

	public function getIdTasks() {
		return $this->hasOne(Tasks::class, ['id' => 'task_id']);
	}

	public function getIdExecutor() {
		return $this->hasOne(Users::class, ['id' => 'executor_id']);
	}

	public function getIdCustomer() {
		return $this->hasOne(Users::class, ['id' => 'customer_id']);
	}
}
