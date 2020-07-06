<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{

	public $email;
	public $password;
	private $_user;

	public function attributeLabels()
	{
		return [
			'email' => 'Электронная почта',
			'password' => 'Пароль',
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [

			[['email', 'password'], 'safe'],
			[['email', 'password'], 'required'],

			['email', 'trim'],
			['email', 'email'],
			['email', 'string', 'max' => 255],
			['password', 'validatePassword']
		];
	}

	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 *
	 * @param string $attribute the attribute currently being validated
	 */
	public function validatePassword($attribute)
	{
		if (!$this->hasErrors()) {
			$user = $this->getUser();
			if (!$user || !$user->validatePassword($this->password)) {
				$this->addError($attribute, 'Неправильный email или пароль');
			}
		}

	}

	public function getUser()
	{
		if ($this->_user === null) {
			$this->_user = Users::findByEmail($this->email);
		}

		return $this->_user;
	}
}
