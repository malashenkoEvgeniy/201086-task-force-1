<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $creation_time
 * @property string $name
 * @property string $email
 * @property int|null $location_id
 * @property string|null $birthday
 * @property string|null $info
 * @property string $password
 * @property string|null $phone
 * @property string|null $skype
 * @property string|null $another_messenger
 * @property string|null $avatar
 * @property string|null $task_name
 * @property int $show_contacts_for_customer
 * @property int $hide_profile
 */
class Users extends \yii\db\ActiveRecord
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
            [['creation_time', 'birthday'], 'safe'],
            [['name', 'email', 'password'], 'required'],
            [['location_id', 'show_contacts_for_customer', 'hide_profile'], 'integer'],
            [['info'], 'string'],
            [['name', 'email', 'password', 'phone', 'skype', 'another_messenger', 'avatar', 'task_name'], 'string', 'max' => 128],
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
        ];
    }
}