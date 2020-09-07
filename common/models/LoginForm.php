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
	private $_user = false;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			// username and password are both required
			[['email', 'password'], 'required'],
			[['email'], 'email'],

			// password is validated by validatePassword()
			['password', 'validatePassword'],
		];
	}

	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 *
	 * @param string $attribute the attribute currently being validated
	 *
	 */
	public function validatePassword($attribute)
	{
		if (!$this->hasErrors()) {
			$user = $this->getUser();

			if (!$user || !$user->validatePassword($this->password)) {
				$this->addError($attribute, 'Incorrect username or password.');
			}

		}
	}

	/**
	 * Logs in a user using the provided username and password.
	 * @return bool whether the user is logged in successfully
	 */
	public function login()
	{
		if ($this->validate()) {
			return Yii::$app->user->login($this->getUser());
		}
		return false;
	}

	/**
	 * Finds user by [[email]]
	 *
	 * @return Users|null
	 */
	public function getUser()
	{
		if ($this->_user === false) {
			$this->_user = Users::findByEmail($this->email);
		}
		return $this->_user;
	}
}
