<?php

namespace frontend\models;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $creation_time
 * @property string $name
 * @property string $email
 * @property int $location_id
 * @property string|null $birthday
 * @property string|null $info
 * @property string $password
 * @property string|null $phone
 * @property string|null $skype
 * @property string|null $another_messenger
 * @property string|null $avatar
 * @property string|null $task_name
 * @property int|null $show_contacts_for_customer
 * @property int|null $hide_profile
 * @property string $last_visit_time
 *
 * @property ChatMessages[] $chatMessages
 * @property EmailSettings[] $emailSettings
 * @property File[] $files
 * @property Proposal[] $proposals
 * @property Reviews[] $reviews
 * @property Reviews[] $reviews0
 * @property Tasks[] $tasks
 * @property Tasks[] $tasks0
 * @property Locations $location
 * @property UsersCategories[] $usersCategories
 */
class Users extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creation_time', 'birthday', 'last_visit_time'], 'safe'],
            [['name', 'email', 'location_id', 'password', 'last_visit_time'], 'required'],
            [['location_id', 'show_contacts_for_customer', 'hide_profile'], 'integer'],
            [['info'], 'string'],
            [['name', 'email', 'password', 'phone', 'skype', 'another_messenger', 'avatar', 'task_name'], 'string', 'max' => 128],
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
            'email' => 'Email',
            'location_id' => 'Location ID',
            'birthday' => 'Birthday',
            'info' => 'Info',
            'password' => 'Password',
            'phone' => 'Phone',
            'skype' => 'Skype',
            'another_messenger' => 'Another Messenger',
            'avatar' => 'Avatar',
            'task_name' => 'Task Name',
            'show_contacts_for_customer' => 'Show Contacts For Customer',
            'hide_profile' => 'Hide Profile',
            'last_visit_time' => 'Last Visit Time',
        ];
    }

    /**
     * Gets query for [[ChatMessages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChatMessages()
    {
        return $this->hasMany(ChatMessages::class, ['writer_id' => 'id']);
    }

    /**
     * Gets query for [[EmailSettings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmailSettings()
    {
        return $this->hasMany(EmailSettings::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Proposals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProposals()
    {
        return $this->hasMany(Proposal::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[CustomerReviews]].
     *
     * @return \yii\db\ActiveQuery
     */
		public function getCustomerReviews()
		{
			return $this->hasMany(Reviews::class, ['customer_id' => 'id']);
		}

    /**
     * Gets query for [[ExecutorReviews]].
     *
     * @return \yii\db\ActiveQuery
     */
		public function getExecutorReviews()
		{
			return $this->hasMany(Reviews::class, ['executor_id' => 'id']);
		}

    /**
     * Gets query for [[CustomerTasks]].
     *
     * @return \yii\db\ActiveQuery
     */
		public function getCustomerTasks()
		{
			return $this->hasMany(Tasks::class, ['customer_id' => 'id']);
		}

    /**
     * Gets query for [[ExecutorTasks]].
     *
     * @return \yii\db\ActiveQuery
     */
		public function getExecutorTasks()
		{
			return $this->hasMany(Tasks::class, ['executor_id' => 'id']);
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

	/**
	 * Gets query for [[UsersCategories]].
	 *
	 * @return \yii\db\ActiveQuery
	 * @throws \yii\base\InvalidConfigException
	 */
	public function getCategories()
	{
		return $this->hasMany(Categories::class, ['id' => 'category_id'])
			->viaTable('users_categories', ['user_id' => 'id']);
	}
}
