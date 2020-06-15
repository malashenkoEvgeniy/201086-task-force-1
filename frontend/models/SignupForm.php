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
    public $name;
   	public $email;
    public $password;
    public $location_id;
   	public $verification_token;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
						['name', 'trim'],
            ['name', 'required'],
            ['name', 'unique', 'targetClass' => '\common\models\Users', 'message' => 'Необходимо заполнить «Имя».'],
            ['name', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Users', 'message' => 'Необходимо заполнить «email».'],

            ['password', 'required', 'message' => 'Необходимо заполнить «ПАРОЛЬ».'],
            ['password', 'string', 'min' => 8],
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
			$user->name = $this->name;

			$user->location_id = $this->location_id;
			echo $user->location_id ;
			$user->email = $this->email;

			$user->setPassword($this->password);
			$user->generateAuthKey();
			$user->generateEmailVerificationToken();
			if(!$user->save()){
				echo 1;
			}
			return $user->save();

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
