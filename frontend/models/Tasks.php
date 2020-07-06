<?php

namespace frontend\models;



use common\models\Users;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $creation_time
 * @property string $name
 * @property int $category_id
 * @property string|null $description
 * @property int $location_id
 * @property int|null $budget
 * @property string $deadline
 * @property int $customer_id
 * @property int|null $executor_id
 * @property int $status
 *
 * @property ChatMessages[] $chatMessages
 * @property File[] $files
 * @property Proposal[] $proposals
 * @property Reviews[] $reviews
 * @property Categories $category
 * @property Users $customer
 * @property Users $executor
 * @property Locations $location
 */
class Tasks extends ActiveRecord
{
	const STATUS = ['Новое', 'Отменено', 'В работе', 'Выполнено', 'Провалено'];

	public $layout = 'main.php';
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
            [['name', 'category_id', 'location_id', 'deadline', 'customer_id'], 'required'],
            [['category_id', 'location_id', 'budget', 'customer_id', 'executor_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['executor_id' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::className(), 'targetAttribute' => ['location_id' => 'id']],
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

		/**
		 * Gets query for [[ChatMessages]].
		 *
		 * @return \yii\db\ActiveQuery
		 */
		public function getChatMessages()
		{
			return $this->hasMany(ChatMessages::class, ['task_id' => 'id']);
		}

		/**
		 * Gets query for [[Files]].
		 *
		 * @return \yii\db\ActiveQuery
		 */
		public function getFiles()
		{
			return $this->hasMany(File::class, ['task_id' => 'id']);
		}

		/**
		 * Gets query for [[Proposals]].
		 *
		 * @return \yii\db\ActiveQuery
		 */
		public function getProposals()
		{
			return $this->hasMany(Proposal::class, ['task_id' => 'id']);
		}

		/**
		 * Gets query for [[Reviews]].
		 *
		 * @return \yii\db\ActiveQuery
		 */
		public function getReviews()
		{
			return $this->hasMany(Reviews::class, ['task_id' => 'id']);
		}

		/**
		 * Gets query for [[Category]].
		 *
		 * @return \yii\db\ActiveQuery
		 */
		public function getCategory()
		{
			return $this->hasOne(Categories::class, ['id' => 'category_id']);
		}

		/**
		 * Gets query for [[Customer]].
		 *
		 * @return \yii\db\ActiveQuery
		 */
		public function getCustomer()
		{
			return $this->hasOne(Users::class, ['id' => 'customer_id']);
		}

		/**
		 * Gets query for [[Executor]].
		 *
		 * @return \yii\db\ActiveQuery
		 */
		public function getExecutor()
		{
			return $this->hasOne(Users::class, ['id' => 'executor_id']);
		}

		/**
		 * Gets query for [[Location]].
		 *
		 * @return \yii\db\ActiveQuery
		 */
		public function getLocation()
		{
			return $this->hasOne(Locations::class, ['id' => 'location_id']);
		}
}
