<?php

namespace frontend\models;

use app\models\Favorites;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $creation_time
 * @property string $name
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $location_id
 * @property string|null $birthday
 * @property string|null $info
 * @property string|null $phone
 * @property string|null $skype
 * @property string|null $another_messenger
 * @property string|null $avatar
 * @property string|null $task_name
 * @property int|null $show_contacts_for_customer
 * @property int|null $hide_profile
 * @property string|null $last_visit_time
 * @property int $count_orders
 * @property int $popularity
 * @property int|null $now_free
 * @property int|null $has_reviews
 * @property int|null $is_executor
 * @property int|null $count_reviews
 * @property int|null $rating
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ChatMessages[] $chatMessages
 * @property EmailSettings[] $emailSettings
 * @property File[] $files
 * @property Proposal[] $proposals
 * @property Reviews[] $reviews
 * @property Reviews[] $reviews0
 * @property Tasks[] $tasks
 * @property Tasks[] $tasks0
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
            [['name', 'auth_key', 'password_hash', 'email', 'location_id', 'created_at', 'updated_at'], 'required'],
            [['location_id', 'show_contacts_for_customer', 'hide_profile', 'count_orders', 'popularity', 'now_free', 'has_reviews', 'is_executor', 'count_reviews', 'rating', 'status', 'created_at', 'updated_at'], 'integer'],
            [['info'], 'string'],
            [['name', 'email', 'phone', 'skype', 'another_messenger', 'avatar', 'task_name'], 'string', 'max' => 128],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
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
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'location_id' => 'Location ID',
            'birthday' => 'Birthday',
            'info' => 'Info',
            'phone' => 'Phone',
            'skype' => 'Skype',
            'another_messenger' => 'Another Messenger',
            'avatar' => 'Avatar',
            'task_name' => 'Task Name',
            'show_contacts_for_customer' => 'Show Contacts For Customer',
            'hide_profile' => 'Hide Profile',
            'last_visit_time' => 'Last Visit Time',
            'count_orders' => 'Count Orders',
            'popularity' => 'Popularity',
            'now_free' => 'Now Free',
            'has_reviews' => 'Has Reviews',
            'is_executor' => 'Is Executor',
            'count_reviews' => 'Count Reviews',
            'rating' => 'Rating',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
	/**
	 * Gets query for [[Favorites]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getFavorites()
	{
		return $this->hasMany(Favorites::class, ['user_id' => 'id']);
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
