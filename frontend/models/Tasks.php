<?php

namespace app\models;

use Yii\db\ActiveRecord;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $creation_time
 * @property string $name
 * @property int $category_id
 * @property string|null $description
 * @property int|null $location_id
 * @property int|null $budget
 * @property string $deadline
 * @property int $customer_id
 * @property int|null $executor_id
 * @property string|null $status
 */
class Tasks extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creation_time', 'deadline'], 'safe'],
            [['name', 'category_id', 'deadline', 'customer_id'], 'required'],
            [['category_id', 'location_id', 'budget', 'customer_id', 'executor_id'], 'integer'],
            [['description'], 'string'],
            [['name', 'status'], 'string', 'max' => 128],
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
            'name' => 'Name',
            'category_id' => 'Category ID',
            'description' => 'Description',
            'location_id' => 'Location ID',
            'budget' => 'Budget',
            'deadline' => 'Deadline',
            'customer_id' => 'Customer ID',
            'executor_id' => 'Executor ID',
            'status' => 'Status',
        ];
    }

	public function getCategories() {
		return $this->hasOne(Categories::class, ['id' => 'category_id']);
	}

	public function getPropasal() {
		return $this->hasMany(Proposal::class, ['task_id' => 'id']);
	}

	public function getIdReviews() {
		return $this->hasOne(Reviews::class, ['task_id' => 'id']);
	}

	public function getIdLocation() {
		return $this->hasOne(Locations::class, ['id' => 'location_id']);
	}

	public function getIdTasksExecutor() {
		return $this->hasOne(Users::class, ['executor_id' => 'id']);
	}

	public function getIdTasksCustomer() {
		return $this->hasOne(Users::class, ['customer_id' => 'id']);
	}

	public function getChatMessages() {
		return $this->hasMany(ChatMessages::class, ['task_id' => 'id'])->inverseOf('chatMessages');
	}

	public function getIdFile() {
		return $this->hasOne(File::class, ['task_id' => 'id']);
	}
}
