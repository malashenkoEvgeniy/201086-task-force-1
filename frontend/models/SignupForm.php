<?php
namespace frontend\models;

use common\models\Users;
use Yii;
use yii\base\Model;


/**
 * Signup form
 */
class SignupForm extends Model
{
		public $username;
		public $email;
		public $password;
		public $location_id;
   	//public $verification_token;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
						['username', 'trim'],
						['username', 'required'],
						['username', 'unique', 'targetClass' => '\common\models\Users', 'message' => 'This username has already been taken.'],
						['username', 'string', 'min' => 2, 'max' => 255],

						['email', 'trim'],
						['email', 'required'],
						['email', 'email'],
						['email', 'string', 'max' => 255],
						['email', 'unique', 'targetClass' => '\common\models\Users', 'message' => 'This email address has already been taken.'],

						['password', 'required'],
						['password', 'string', 'min' => 6],

						['location_id', 'integer'],
        ];
    }

    /**
     * Signs users up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
        		echo 'ошибка регистрации';
            return null;
        }

			$user = new Users();
			$user->username = $this->username;
			$user->email = $this->email;
			$user->location_id = $this->location_id;
			$user->setPassword($this->password);
			$user->generateAuthKey();
			$user->generateEmailVerificationToken();
			return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param Users $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
